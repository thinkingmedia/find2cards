goog.provide('gmMem.Directives.gmCard');
goog.require('gmMem.Directives');

/**
 * @name gmMem.Directives.gmCardScope
 * @extends ng.IScope
 *
 * @property {gmMem.Directives.gmCardCtrl} ctrl
 * @property {boolean} visible
 * @property {number} score
 */

/**
 * @name gmMem.Directives.gmCardCtrl
 *
 * @param {gmMem.Directives.gmCardScope} $scope
 *
 * @constructor
 */
gmMem.Directives.gmCardCtrl = function($scope)
{
	this._$scope = $scope;
	this._$scope.visible = false;
	this._$scope.ctrl = this;
	this._$scope.score = 0;
};

/**
 * @returns {ng.IDirective}
 */
gmMem.Directives.gmCard = function()
{
	/**
	 * @param {gmMem.Directives.gmCardScope} $scope
	 * @param {JQuery} $el
	 * @param {ng.IAttributes} $attr
	 * @param {gmMem.Directives.gmGameCtrl} gameCtrl
	 * @private
	 */
	function _link($scope, $el, $attr, gameCtrl)
	{
		var $score = $el.find('.score');
		var $back = $el.find('.back');

		$scope.$watchGroup(['width', 'height'], function(size)
		{
			$el.css({
						'width':  size[0] + 'px',
						'height': size[1] + 'px',
						'left':   $scope.data.col * size[0],
						'top':    $scope.data.row * size[1]
					});

			var font = {
				'font-size':   ~~(size[1] * 0.8) + 'px',
				'line-height': ~~(size[1] * 0.8) + 'px'
			};

			$score.css(font);
			$back.css(font);
		});
		$scope.$watch('visible', function(value)
		{
			$el.toggleClass('flip', value);
		});
		$el.on('click', function()
		{
			if(!$scope.visible)
			{
				$scope.$apply(function()
							  {
								  $scope.visible = true;
								  gameCtrl.shown($scope.data.id);
							  });
			}
		});
		$scope.$on(gmMem.Directives.gmGameCtrl.RESET, function(event, id)
		{
			if(id == $scope.data.id)
			{
				$scope.visible = false;
			}
		});
	}

	return {
		restrict:    'EA',
		require:     '^gmGame',
		scope:       {
			'data':   '=',
			'width':  '=',
			'height': '='
		},
		link:        _link,
		controller:  [
			'$scope',
			gmMem.Directives.gmCardCtrl
		],
		templateUrl: '/src/gmMem/Directives/gmCard/gmCard.html'
	}
};

gmMem.Angular.directive('gmCard', [
	gmMem.Directives.gmCard
]);