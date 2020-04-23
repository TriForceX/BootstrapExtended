/// <reference path="../../../js/knockout.d.ts" />
/// <reference path="../../../js/jquery.d.ts" />
/// <reference path="../../../js/lodash-3.10.d.ts" />
/// <reference path="../../../modules/actor-selector/actor-selector.ts" />
/// <reference path="../../../js/jquery.biscuit.d.ts" />
var AmeTweakItem = /** @class */ (function () {
    function AmeTweakItem(properties, module) {
        var _this = this;
        this.id = properties.id;
        this.label = properties.label;
        this.children = [];
        this.module = module;
        this.enabledForActor = new AmeObservableActorSettings(properties.enabledForActor || null);
        var _isIndeterminate = ko.observable(false);
        this.isIndeterminate = ko.computed(function () {
            if (module.selectedActor() !== null) {
                return false;
            }
            return _isIndeterminate();
        });
        this.isChecked = ko.computed({
            read: function () {
                var selectedActor = _this.module.selectedActor();
                if (selectedActor === null) {
                    //All: Checked only if it's checked for all actors.
                    var allActors = _this.module.actorSelector.getVisibleActors();
                    var isEnabledForAll = true, isEnabledForAny = false;
                    for (var index = 0; index < allActors.length; index++) {
                        if (_this.enabledForActor.get(allActors[index].getId(), false)) {
                            isEnabledForAny = true;
                        }
                        else {
                            isEnabledForAll = false;
                        }
                    }
                    _isIndeterminate(isEnabledForAny && !isEnabledForAll);
                    return isEnabledForAll;
                }
                //Is there an explicit setting for this actor?
                var ownSetting = _this.enabledForActor.get(selectedActor.getId(), null);
                if (ownSetting !== null) {
                    return ownSetting;
                }
                if (selectedActor instanceof AmeUser) {
                    //The "Super Admin" setting takes precedence over regular roles.
                    if (selectedActor.isSuperAdmin) {
                        var superAdminSetting = _this.enabledForActor.get(AmeSuperAdmin.permanentActorId, null);
                        if (superAdminSetting !== null) {
                            return superAdminSetting;
                        }
                    }
                    //Is it enabled for any of the user's roles?
                    for (var i = 0; i < selectedActor.roles.length; i++) {
                        var groupSetting = _this.enabledForActor.get('role:' + selectedActor.roles[i], null);
                        if (groupSetting === true) {
                            return true;
                        }
                    }
                }
                //All tweaks are unchecked by default.
                return false;
            },
            write: function (checked) {
                var selectedActor = _this.module.selectedActor();
                if (selectedActor === null) {
                    //Enable/disable this tweak for all actors.
                    if (checked === false) {
                        //Since false is the default, this is the same as removing/resetting all values.
                        _this.enabledForActor.resetAll();
                    }
                    else {
                        var allActors = _this.module.actorSelector.getVisibleActors();
                        for (var i = 0; i < allActors.length; i++) {
                            _this.enabledForActor.set(allActors[i].getId(), checked);
                        }
                    }
                }
                else {
                    _this.enabledForActor.set(selectedActor.getId(), checked);
                }
                //Apply the same setting to all children.
                for (var i = 0; i < _this.children.length; i++) {
                    _this.children[i].isChecked(checked);
                }
            }
        });
    }
    AmeTweakItem.prototype.toJs = function () {
        //Since all tweaks are disabled by default, having a tweak disabled for a role is the same
        //as not having a setting, so we can save some space by removing it. This does not always
        //apply to users/Super Admins because they can have precedence over roles.
        var temp = this.enabledForActor.getAll();
        var enabled = {};
        var areAllFalse = true;
        for (var actorId in temp) {
            if (!temp.hasOwnProperty(actorId)) {
                continue;
            }
            areAllFalse = areAllFalse && (!temp[actorId]);
            if (!temp[actorId]) {
                var actor = AmeActors.getActor(actorId);
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
    };
    return AmeTweakItem;
}());
var AmeTweakSection = /** @class */ (function () {
    function AmeTweakSection(properties) {
        this.tweaks = [];
        this.id = properties.id;
        this.label = properties.label;
        this.isOpen = ko.observable(true);
    }
    AmeTweakSection.prototype.addTweak = function (tweak) {
        this.tweaks.push(tweak);
    };
    AmeTweakSection.prototype.hasContent = function () {
        return this.tweaks.length > 0;
    };
    AmeTweakSection.prototype.toggle = function () {
        this.isOpen(!this.isOpen());
    };
    return AmeTweakSection;
}());
var AmeTweakManagerModule = /** @class */ (function () {
    function AmeTweakManagerModule(scriptData) {
        var _this = this;
        this.tweaksById = {};
        this.sectionsById = {};
        this.sections = [];
        var _ = AmeTweakManagerModule._;
        this.actorSelector = new AmeActorSelector(AmeActors, scriptData.isProVersion);
        this.selectedActorId = this.actorSelector.createKnockoutObservable(ko);
        this.selectedActor = ko.computed(function () {
            var id = _this.selectedActorId();
            if (id === null) {
                return null;
            }
            return AmeActors.getActor(id);
        });
        //Reselect the previously selected actor.
        this.selectedActorId(scriptData.selectedActor);
        //Sort sections by priority, then by label.
        var sectionData = _.sortByAll(scriptData.sections, ['priority', 'label']);
        //Register sections.
        _.forEach(sectionData, function (properties) {
            var section = new AmeTweakSection(properties);
            _this.sectionsById[section.id] = section;
            _this.sections.push(section);
        });
        var firstSection = this.sections[0];
        _.forEach(scriptData.tweaks, function (properties) {
            var tweak = new AmeTweakItem(properties, _this);
            _this.tweaksById[tweak.id] = tweak;
            if (properties.parentId && _this.tweaksById.hasOwnProperty(properties.parentId)) {
                _this.tweaksById[properties.parentId].children.push(tweak);
            }
            else {
                var ownerSection = firstSection;
                if (properties.sectionId && _this.sectionsById.hasOwnProperty(properties.sectionId)) {
                    ownerSection = _this.sectionsById[properties.sectionId];
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
        this.openSectionIds = ko.computed({
            read: function () {
                var result = [];
                _.forEach(_this.sections, function (section) {
                    if (section.isOpen()) {
                        result.push(section.id);
                    }
                });
                return result;
            },
            write: function (sectionIds) {
                var openSections = _.indexBy(sectionIds);
                _.forEach(_this.sections, function (section) {
                    section.isOpen(openSections.hasOwnProperty(section.id));
                });
            }
        });
        this.openSectionIds.extend({ rateLimit: { timeout: 1000, method: 'notifyWhenChangesStop' } });
        var initialState = null;
        var cookieValue = jQuery.cookie(AmeTweakManagerModule.openSectionCookieName);
        if ((typeof cookieValue === 'string') && JSON && JSON.parse) {
            var storedState = JSON.parse(cookieValue);
            if (_.isArray(storedState)) {
                initialState = _.intersection(_.keys(this.sectionsById), storedState);
            }
        }
        if (initialState !== null) {
            this.openSectionIds(initialState);
        }
        else {
            this.openSectionIds([_.first(this.sections).id]);
        }
        this.openSectionIds.subscribe(function (sectionIds) {
            jQuery.cookie(AmeTweakManagerModule.openSectionCookieName, ko.toJSON(sectionIds), { expires: 90 });
        });
        this.settingsData = ko.observable('');
        this.isSaving = ko.observable(false);
    }
    AmeTweakManagerModule.prototype.saveChanges = function () {
        this.isSaving(true);
        var _ = wsAmeLodash;
        var data = {
            'tweaks': _.indexBy(_.invoke(this.tweaksById, 'toJs'), 'id'),
        };
        this.settingsData(ko.toJSON(data));
        return true;
    };
    AmeTweakManagerModule._ = wsAmeLodash;
    AmeTweakManagerModule.openSectionCookieName = 'ame_tmce_open_sections';
    return AmeTweakManagerModule;
}());
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
