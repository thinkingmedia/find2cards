goog.provide('gmMem.Directives.gmPlayer');
goog.require('gmMem.Directives');

/**
 * @name gmMem.Directives.gmPlayerScope
 * @extends ng.IScope
 *
 * @property {gmMem.Directives.gmPlayerCtrl} ctrl
 */

/**
 * @name gmMem.Directives.gmPlayerCtrl
 *
 * @param {gmMem.Directives.gmPlayerScope} $scope
 *
 * @constructor
 */
gmMem.Directives.gmPlayerCtrl = function($scope)
{
	this._$scope = $scope;
	this._$scope.ctrl = this;
};

/**
 * @returns {ng.IDirective}
 */
gmMem.Directives.gmPlayer = function()
{
	/**
	 * @param {gmMem.Directives.gmPlayerScope} $scope
	 * @param {JQuery} $el
	 * @param {ng.IAttributes} $attr
	 * @private
	 */
	function _link($scope, $el, $attr)
	{
	}

	return {
		restrict:    'EA',
		scope:       {
			'image': '@',
			'size':  '@'
		},
		link:        _link,
		controller:  [
			'$scope',
			gmMem.Directives.gmPlayerCtrl
		],
		templateUrl: '/src/gmMem/Directives/gmPlayer/gmPlayer.html'
	}
};

gmMem.Angular.directive('gmPlayer', [
	gmMem.Directives.gmPlayer
]);