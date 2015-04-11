goog.provide('gmMem.Directives.gmTimer');
goog.require('gmMem.Directives');

/**
 * @name gmMem.Directives.gmTimerScope
 * @extends ng.IScope
 *
 * @property {number} value
 * @property {Array.<string>} digits
 * @property {gmMem.Directives.gmTimerCtrl} ctrl
 */

/**
 * @name gmMem.Directives.gmTimerCtrl
 *
 * @param {gmMem.Directives.gmTimerScope} $scope
 *
 * @constructor
 */
gmMem.Directives.gmTimerCtrl = function($scope)
{
	this._$scope = $scope;
	this._$scope.ctrl = this;
};

/**
 * @param {ng.IIntervalService} $interval
 *
 * @returns {ng.IDirective}
 */
gmMem.Directives.gmTimer = function($interval)
{
	/**
	 * @param {gmMem.Directives.gmTimerScope} $scope
	 * @param {JQuery} $el
	 * @param {ng.IAttributes} $attr
	 * @private
	 */
	function _link($scope, $el, $attr)
	{
		$scope.value = ~~$scope.value;
		$interval(function()
				  {
					  $scope.value = $scope.value == 0 ? 0 : $scope.value - 1;
				  }, 1000);

		$scope.$watch('value', function(value)
		{
			var time = new Date(0, 0, 0, 0, 0, value).toTimeString().replace(/.*(\d{2}:\d{2}).*/, "$1");
			$scope.digits = (time || '').toString().split('');
		});
	}

	return {
		restrict:    'EA',
		scope:       {
			value: '@'
		},
		link:        _link,
		controller:  [
			'$scope',
			gmMem.Directives.gmTimerCtrl
		],
		templateUrl: '/src/gmMem/Directives/gmTimer/gmTimer.html'
	}
};

gmMem.Angular.directive('gmTimer', [
	'$interval',
	gmMem.Directives.gmTimer
]);