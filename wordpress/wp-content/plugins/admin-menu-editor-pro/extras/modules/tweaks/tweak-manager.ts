/// <reference path="../../../js/knockout.d.ts" />
/// <reference path="../../../js/jquery.d.ts" />
/// <reference path="../../../js/lodash-3.10.d.ts" />
/// <reference path="../../../modules/actor-selector/actor-selector.ts" />
/// <reference path="../../../js/jquery.biscuit.d.ts" />

declare let ameTweakManager: AmeTweakManagerModule;
declare const wsTweakManagerData: AmeTweakManagerScriptData;

interface AmeTweakManagerScriptData {
	selectedActor: string;
	isProVersion: boolean;
	tweaks: AmeTweakProperties[];
	sections: AmeSectionProperties[];
}

interface AmeTweakProperties {
	id: string;
	label: string;
	description?: string;
	parentId?: string;
	enabledForActor?: AmeDictionary<boolean>;
	sectionId?: string;
}

interface AmeSavedTweakProperties {
	id: string;
	enabledForActor: AmeDictionary<boolean>;
}

class AmeTweakItem {
	id: string;
	label: string;
	children: AmeTweakItem[];

	isChecked: KnockoutComputed<boolean>;
	private enabledForActor: AmeObservableActorSettings;
	private module: AmeTweakManagerModule;

	isIndeterminate: KnockoutComputed<boolean>;

	constructor(properties: AmeTweakProperties, module: AmeTweakManagerModule) {
		this.id = properties.id;
		this.label = properties.label;
		this.children = [];

		this.module = module;
		this.enabledForActor = new AmeObservableActorSettings(properties.enabledForActor || null);

		let _isIndeterminate = ko.observable<boolean>(false);
		this.isIndeterminate = ko.computed<boolean>(() => {
			if (module.selectedActor() !== null) {
				return false;
			}
			return _isIndeterminate();
		});

		this.isChecked = ko.computed<boolean>({
			read: () => {
				const selectedActor = this.module.selectedActor();

				if (selectedActor === null) {
					//All: Checked only if it's checked for all actors.
					const allActors = this.module.actorSelector.getVisibleActors();
					let isEnabledForAll = true, isEnabledForAny = false;
					for (let index = 0; index < allActors.length; index++) {
						if (this.enabledForActor.get(allActors[index].getId(), false)) {
							isEnabledForAny = true;
						} else {
							isEnabledForAll = false;
						}
					}

					_isIndeterminate(isEnabledForAny && !isEnabledForAll);

					return isEnabledForAll;
				}

				//Is there an explicit setting for this actor?
				let ownSetting = this.enabledForActor.get(selectedActor.getId(), null);
				if (ownSetting !== null) {
					return ownSetting;
				}

				if (selectedActor instanceof AmeUser) {
					//The "Super Admin" setting takes precedence over regular roles.
					if (selectedActor.isSuperAdmin) {
						let superAdminSetting = this.enabledForActor.get(AmeSuperAdmin.permanentActorId, null);
						if (superAdminSetting !== null) {
							return superAdminSetting;
						}
					}

					//Is it enabled for any of the user's roles?
					for (let i = 0; i < selectedActor.roles.length; i++) {
						let groupSetting = this.enabledForActor.get('role:' + selectedActor.roles[i], null);
						if (groupSetting === true) {
							return true;
						}
					}
				}

				//All tweaks are unchecked by default.
				return false;
			},
			write: (checked: boolean) => {
				const selectedActor = this.module.selectedActor();
				if (selectedActor === null) {
					//Enable/disable this tweak for all actors.
					if (checked === false) {
						//Since false is the default, this is the same as removing/resetting all values.
						this.enabledForActor.resetAll();
					} else {
						const allActors = this.module.actorSelector.getVisibleActors();
						for (let i = 0; i < allActors.length; i++) {
							this.enabledForActor.set(allActors[i].getId(), checked);
						}
					}
				} else {
					this.enabledForActor.set(selectedActor.getId(), checked);
				}

				//Apply the same setting to all children.
				for (let i = 0; i < this.children.length; i++) {
					this.children[i].isChecked(checked);
				}
			}
		});
	}

	toJs(): AmeSavedTweakProperties {
		//Since all tweaks are disabled by default, having a tweak disabled for a role is the same
		//as not having a setting, so we can save some space by removing it. This does not always
		//apply to users/Super Admins because they can have precedence over roles.
		let temp = this.enabledForActor.getAll();
		let enabled: AmeDictionary<boolean> = {};
		let areAllFalse = true;
		for (let actorId in temp) {
			if (!temp.hasOwnProperty(actorId)) {
				continue;
			}

			areAllFalse = areAllFalse && (!temp[actorId]);
			if (!temp[actorId]) {
				const actor = AmeActors.getActor(actorId);
				if (actor instanceof AmeRole) {
					continue;
				}
			}
			enabled[actorId] = temp[actorId];
		}

		if (areAllFalse) {
			enabled = {};
		}

		return {
			id: this.id,
			enabledForActor: enabled
		};
	}
}

interface AmeSectionProperties {
	id: string;
	label: string;
	priority: number | null;
}

class AmeTweakSection {
	id: string;
	label: string;
	tweaks: AmeTweakItem[] = [];
	isOpen: KnockoutObservable<boolean>;

	constructor(properties: AmeSectionProperties) {
		this.id = properties.id;
		this.label = properties.label;
		this.isOpen = ko.observable<boolean>(true);
	}

	addTweak(tweak: AmeTweakItem) {
		this.tweaks.push(tweak);
	}

	hasContent() {
		return this.tweaks.length > 0;
	}

	toggle() {
		this.isOpen(!this.isOpen());
	}
}

class AmeTweakManagerModule {
	static _ = wsAmeLodash;
	static readonly openSectionCookieName = 'ame_tmce_open_sections';

	readonly actorSelector: AmeActorSelector;
	selectedActorId: KnockoutComputed<string>;
	selectedActor: KnockoutComputed<IAmeActor>;

	private tweaksById: { [id: string]: AmeTweakItem } = {};
	private sectionsById: AmeDictionary<AmeTweakSection> = {};
	sections: AmeTweakSection[] = [];

	settingsData: KnockoutObservable<string>;
	isSaving: KnockoutObservable<boolean>;

	private readonly openSectionIds: KnockoutComputed<string[]>;

	constructor(scriptData: AmeTweakManagerScriptData) {
		const _ = AmeTweakManagerModule._;

		this.actorSelector = new AmeActorSelector(AmeActors, scriptData.isProVersion);
		this.selectedActorId = this.actorSelector.createKnockoutObservable(ko);
		this.selectedActor = ko.computed<IAmeActor>(() => {
			const id = this.selectedActorId();
			if (id === null) {
				return null;
			}
			return AmeActors.getActor(id);
		});

		//Reselect the previously selected actor.
		this.selectedActorId(scriptData.selectedActor);

		//Sort sections by priority, then by label.
		let sectionData = _.sortByAll(scriptData.sections, ['priority', 'label']);
		//Register sections.
		_.forEach(sectionData, (properties) => {
			let section = new AmeTweakSection(properties);
			this.sectionsById[section.id] = section;
			this.sections.push(section);
		});
		const firstSection = this.sections[0];

		_.forEach(scriptData.tweaks, (properties) => {
			const tweak = new AmeTweakItem(properties, this);
			this.tweaksById[tweak.id] = tweak;

			if (properties.parentId && this.tweaksById.hasOwnProperty(properties.parentId)) {
				this.tweaksById[properties.parentId].children.push(tweak);
			} else {
				let ownerSection = firstSection;
				if (properties.sectionId && this.sectionsById.hasOwnProperty(properties.sectionId)) {
					ownerSection = this.sectionsById[properties.sectionId];
				}
				ownerSection.addTweak(tweak);
			}
		});

		//Remove empty sections.
		this.sections = _.filter(this.sections, function (section) {
			return section.hasContent();
		});

		//By default, all sections except the first one are closed.
		//The user can open/close sections and we automatically remember their state.
		this.openSectionIds = ko.computed<string[]>({
			read: () => {
				let result = [];
				_.forEach(this.sections, section => {
					if (section.isOpen()) {
						result.push(section.id);
					}
				});
				return result;
			},
			write: (sectionIds: string[]) => {
				const openSections = _.indexBy(sectionIds);
				_.forEach(this.sections, section => {
					section.isOpen(openSections.hasOwnProperty(section.id));
				});
			}
		});
		this.openSectionIds.extend({rateLimit: {timeout: 1000, method: 'notifyWhenChangesStop'}});

		let initialState: string[] = null;
		let cookieValue = jQuery.cookie(AmeTweakManagerModule.openSectionCookieName);
		if ((typeof cookieValue === 'string') && JSON && JSON.parse) {
			let storedState = JSON.parse(cookieValue);
			if (_.isArray<string>(storedState)) {
				initialState = _.intersection(_.keys(this.sectionsById), storedState);
			}
		}

		if (initialState !== null) {
			this.openSectionIds(initialState);
		} else {
			this.openSectionIds([_.first(this.sections).id]);
		}

		this.openSectionIds.subscribe((sectionIds) => {
			jQuery.cookie(AmeTweakManagerModule.openSectionCookieName, ko.toJSON(sectionIds), {expires: 90});
		});

		this.settingsData = ko.observable<string>('');
		this.isSaving = ko.observable<boolean>(false);
	}

	saveChanges() {
		this.isSaving(true);
		const _ = wsAmeLodash;

		let data = {
			'tweaks': _.indexBy(_.invoke(this.tweaksById, 'toJs'), 'id'),
		};
		this.settingsData(ko.toJSON(data));
		return true;
	}
}

//A one-way binding for indeterminate checkbox states.
ko.bindingHandlers['indeterminate'] = {
	update: function (element, valueAccessor) {
		element.indeterminate = !!(ko.unwrap(valueAccessor()));
	}
};

jQuery(function () {
	ameTweakManager = new AmeTweakManagerModule(wsTweakManagerData);
	ko.applyBindings(ameTweakManager, document.getElementById('ame-tweak-manager'));
});