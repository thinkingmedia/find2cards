goog.provide('gmMem.gmSignIn');
goog.require('gmMem');

/**
 * @name gmMem.gmSignInScope
 * @extends ng.IScope
 *
 * @property {gmMem.gmSignInCtrl} ctrl
 */

/**
 * @name gmMem.gmSignInCtrl
 *
 * @param {gmMem.gmSignInScope} $scope
 *
 * @constructor
 */
gmMem.gmSignInCtrl = function($scope)
{
	this._$scope = $scope;
	this._$scope.ctrl = this;
};

/**
 * @returns {ng.IDirective}
 */
gmMem.gmSignIn = function()
{
	/**
	 * @param {gmMem.gmSignInScope} $scope
	 * @param {JQuery} $el
	 * @param {ng.IAttributes} $attr
	 * @private
	 */
	function _link($scope, $el, $attr)
	{
	}

	return {
		restrict:   'EA',
		scope:      {},
		link:       _link,
		controller: [
			'$scope',
			gmMem.gmSignInCtrl
		]
	}
};

gmMem.Angular.directive('gmSignIn', [
	gmMem.gmSignIn
]);