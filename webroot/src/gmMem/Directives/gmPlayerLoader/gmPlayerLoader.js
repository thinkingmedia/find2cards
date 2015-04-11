goog.provide('gmMem.Directives.gmPlayerLoader');
goog.require('gmMem.Directives');

/**
 * @name gmMem.Directives.gmPlayerLoaderScope
 * @extends ng.IScope
 *
 * @property {gmMem.Directives.gmPlayerLoaderCtrl} ctrl
 * @property {string} name
 * @property {string} image
 * @property {boolean} ready
 */

/**
 * @name gmMem.Directives.gmPlayerLoaderCtrl
 *
 * @param {gmMem.Directives.gmPlayerLoaderScope} $scope
 *
 * @constructor
 */
gmMem.Directives.gmPlayerLoaderCtrl = function($scope)
{
	this._$scope = $scope;
	this._$scope.ctrl = this;
};

/**
 * @returns {ng.IDirective}
 */
gmMem.Directives.gmPlayerLoader = function()
{
	/**
	 * @param {gmMem.Directives.gmPlayerLoaderScope} $scope
	 * @param {JQuery} $el
	 * @param {ng.IAttributes} $attr
	 * @private
	 */
	function _link($scope, $el, $attr)
	{
		$scope.state = '';
	}

	return {
		restrict:    'E',
		scope:       {
			name:  '@',
			image: '@',
			ready: '@'
		},
		link:        _link,
		controller:  [
			'$scope',
			gmMem.Directives.gmPlayerLoaderCtrl
		],
		templateUrl: '/src/gmMem/Directives/gmPlayerLoader/gmPlayerLoader.html'
	}
};

gmMem.Angular.directive('gmPlayerLoader', [
	gmMem.Directives.gmPlayerLoader
]);