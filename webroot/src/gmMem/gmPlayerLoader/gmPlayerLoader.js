goog.provide('gmMem.gmPlayerLoader');
goog.require('gmMem');

/**
 * @name gmMem.gmPlayerLoaderScope
 * @extends ng.IScope
 *
 * @property {gmMem.gmPlayerLoaderModel} model
 * @property {gmMem.gmPlayerLoaderCtrl} ctrl
 */

/**
 * @name gmMem.gmPlayerLoaderModel
 *
 * @property {string} username
 * @property {boolean} ready
 * @property {string} state
 */

/**
 * @name gmMem.gmPlayerLoaderCtrl
 *
 * @param {gmMem.gmPlayerLoaderScope} $scope
 *
 * @constructor
 */
gmMem.gmPlayerLoaderCtrl = function($scope)
{
	this._$scope = $scope;
	this._$scope.ctrl = this;
};

/**
 * @returns {ng.IDirective}
 */
gmMem.gmPlayerLoader = function()
{
	/**
	 * @param {gmMem.gmPlayerLoaderScope} $scope
	 * @param {JQuery} $el
	 * @param {ng.IAttributes} $attr
	 * @private
	 */
	function _link($scope, $el, $attr)
	{
		$scope.model = {
			username: 'John Smith',
			ready:    false,
			state:    'busy'
		};
	}

	return {
		restrict:    'E',
		scope:       {},
		link:        _link,
		controller:  [
			'$scope',
			gmMem.gmPlayerLoaderCtrl
		],
		templateUrl: '/src/gmMem/gmPlayerLoader/gmPlayerLoader.html'
	}
};

gmMem.Angular.directive('gmPlayerLoader', [
	gmMem.gmPlayerLoader
]);