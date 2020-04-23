<?php

class ameDelegatedTweak extends ameBaseTweak {
	protected $callback;
	protected $callbackArgs;

	/**
	 * ameDelegatedTweak constructor.
	 *
	 * @param string $id
	 * @param string $label
	 * @param callable $callback
	 * @param array $callbackArgs
	 */
	public function __construct($id, $label, $callback, $callbackArgs = array()) {
		parent::__construct($id, $label);
		$this->callback = $callback;

		if ( !is_array($callbackArgs) ) {
			throw new LogicException('$callbackArgs must be an array');
		}
		$this->callbackArgs = $callbackArgs;
	}

	public function apply() {
		call_user_func_array($this->callback, $this->callbackArgs);
	}
}