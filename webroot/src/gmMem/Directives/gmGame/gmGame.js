goog.provide('gmMem.Directives.gmGame');
goog.require('gmMem.Directives');

/**
 * @name gmMem.Directives.gmGameScope
 * @extends ng.IScope
 *
 * @property {gmMem.Directives.gmGameCtrl} ctrl
 * @property {string} state
 * @property {number} game
 * @property {number} player
 * @property {number} interval
 * @property {Array.<Object>} players
 * @property {Array.<Object>} cards
 *
 * @property {number} card_width
 * @property {number} card_height
 */

/**
 * @name gmMem.Directives.gmGameCtrl
 *
 * @param {gmMem.Directives.gmGameScope} $scope
 * @param {ng.IHttpService} $http
 * @param {Array.<Object>} cards
 *
 * @constructor
 */
gmMem.Directives.gmGameCtrl = function($scope, $http, cards)
{
	this._$scope = $scope;
	this._$http = $http;

	this._$scope.ctrl = this;
	this._$scope.state = 'loading';
	this._$scope.players = [];
	this._$scope.cards = cards;

	var row = 0;
	var col = 0;
	_.each(this._$scope.cards, function(card)
	{
		card.row = row;
		card.col = col++;
		if(col == 4)
		{
			row++;
			col = 0;
		}
	});
};

/**
 * @returns {ng.IHttpPromise<T>}
 */
gmMem.Directives.gmGameCtrl.prototype.update = function()
{
	return this._$http.get('/games/update/' + this._$scope.game)
		.success(function(data)
				 {
					 if(_.isArray(data.players))
					 {
						 this._$scope.players = data.players;
					 }
					 this._$scope.state = '';
				 }.bind(this));
};

/**
 * @param {ng.IWindowService} $window
 * @param {ng.ITimeoutService} $timeout
 *
 * @returns {ng.IDirective}
 */
gmMem.Directives.gmGame = function($window, $timeout)
{
	/**
	 * @param {gmMem.Directives.gmGameScope} $scope
	 * @param {JQuery} $el
	 * @param {ng.IAttributes} $attr
	 * @param {gmMem.Directives.gmGameCtrl} ctrl
	 * @private
	 */
	function _link($scope, $el, $attr, ctrl)
	{
		function resize()
		{
			console.log('resized');
			var $board = $($el).find(".gmGame-Board");
			var width = $board.innerWidth();
			$scope.card_width = ~~(width / 4);
			$scope.card_height = $scope.card_width * 1.5;
		}

		$(window).bind('resize.gmGame', function()
		{
			$scope.$apply(resize);
		});

		$scope.$on('$destroy', function()
		{
			$(window).unbind('resize.gmGame');
		});

		resize();

		function doUpdate()
		{
			ctrl.update()['finally'](function()
									 {
										 $timeout(function()
												  {
													  doUpdate();
												  }, $scope.interval || 2500);
									 });
		}
		doUpdate();
	}

	return {
		restrict:    'EA',
		scope:       {
			'game':     '@',
			'player':   '@',
			'interval': '@'
		},
		link:        _link,
		controller:  [
			'$scope',
			'$http',
			'cards',
			gmMem.Directives.gmGameCtrl
		],
		templateUrl: '/src/gmMem/Directives/gmGame/gmGame.html'
	}
};

gmMem.Angular.directive('gmGame', [
	'$window',
	'$timeout',
	gmMem.Directives.gmGame
]);