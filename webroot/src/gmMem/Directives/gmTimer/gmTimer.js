goog.provide('gmMem.Directives.gmTimer');
goog.require('gmMem.Directives');

/**
 * @name gmMem.Directives.gmTimerScope
 * @extends ng.IScope
 *
 * @property {number} value
 * @property {number} counter
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
		$scope.$watch('value',function(value)
		{
			$scope.counter = value > 0 ? value : 0;
		});


		$interval(function()
				  {
					  $scope.counter = $scope.counter == 0 ? 0 : $scope.counter - 1;
					  var time = new Date(0, 0, 0, 0, 0, $scope.counter).toTimeString().replace(/.*(\d{2}:\d{2}).*/, "$1");
					  $scope.digits = (time || '').toString().split('');
				  }, 1000);
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