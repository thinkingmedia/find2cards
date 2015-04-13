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
 * @property {number} rows
 * @property {number} columns
 * @property {number} bonus
 * @property {number} score
 * @property {number} matches
 */

/**
 * @name gmMem.Directives.gmGameCtrl
 *
 * @param {gmMem.Directives.gmGameScope} $scope
 * @param {ng.IHttpService} $http
 * @param {Array.<Object>} cards
 * @param {ng.ITimeoutService} $timeout
 *
 * @constructor
 */
gmMem.Directives.gmGameCtrl = function($scope, $http, $timeout, cards)
{
	this._$scope = $scope;
	this._$http = $http;
	this._$timeout = $timeout;

	this._$scope.ctrl = this;
	this._$scope.state = '';
	this._$scope.players = [];
	this._$scope.cards = cards;
	this._$scope.bonus = 0;
	this._$scope.score = 0;
	this._$scope.matches = 0;

	this.bonus_step = 10;
	this.flipped = [];
};

gmMem.Directives.gmGameCtrl.RESET = 'gmGame::RESET';

/**
 * Calculates what rows and columns each card belongs in.
 *
 * @param {number} columns
 */
gmMem.Directives.gmGameCtrl.prototype.arrange = function(columns)
{
	var row = 0;
	var col = 0;
	_.each(this._$scope.cards, function(card)
	{
		card.row = row;
		card.col = col++;
		if(col == columns)
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
	return this._$http.get('/games/update/' + this._$scope.game + '/' + this._$scope.score + '/' + this._$scope.matches)
		.success(function(data)
				 {
					 if(_.isArray(data.players))
					 {
						 this._$scope.players = data.players;
						 _.each(data.players,function(player)
						 {
							 if(player.matches == 12 && player.user.id != this._$scope.player)
							 {
								 this._$scope.state = 'lost';
							 }
						 },this);
					 }
				 }.bind(this));
};

/**
 * Adjusts the size of the cards to fit the width.
 *
 * @param {number} width
 * @param {number} height
 */
gmMem.Directives.gmGameCtrl.prototype.resize = function(width, height)
{
	var landscape = width > height;
	this._$scope.columns = landscape ? 6 : 4;
	this._$scope.rows = landscape ? 4 : 6;
	this._$scope.card_width = ~~(width / this._$scope.columns);
	this._$scope.card_height = ~~(height / this._$scope.rows);
	this.arrange(this._$scope.columns);
};

/**
 * Called when a card is shown.
 *
 * @param {number} card_id
 */
gmMem.Directives.gmGameCtrl.prototype.shown = function(card_id)
{
	this.flipped.push(card_id);
	if(this.flipped.length == 2)
	{
		var score = this.match(this.flipped[0], this.flipped[1]);
		var reset = this.flipped;
		this._$timeout(function()
					   {
						   this._$scope.$broadcast(gmMem.Directives.gmGameCtrl.RESET, reset[0], score);
						   this._$scope.$broadcast(gmMem.Directives.gmGameCtrl.RESET, reset[1], score);
					   }.bind(this), score == 0 ? 500 : 0);
		this.flipped = [];
	}
};

/**
 * Performs the match logic for two cards.
 * @param {number} card_a
 * @param {number} card_b
 * @returns {number}
 */
gmMem.Directives.gmGameCtrl.prototype.match = function(card_a, card_b)
{
	if(this._$scope.cards['card-' + card_a].type == this._$scope.cards['card-' + card_b].type)
	{
		this._$scope.bonus += this.bonus_step;
		this._$scope.matches++;
	}
	else
	{
		this._$scope.bonus = 0;
	}

	this._$scope.score += this._$scope.bonus;

	if(this._$scope.matches == 12)
	{
		this._$scope.state = 'won';
	}

	return this._$scope.bonus;
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
		var $board = $el.find('.gmGame-Board');

		$(window).bind('resize.gmGame', function()
		{
			$scope.$apply(function()
						  {
							  ctrl.resize($board.innerWidth(), $board.innerHeight());
						  });
		});
		$scope.$on('$destroy', function()
		{
			$(window).unbind('resize.gmGame');
		});
		ctrl.resize($board.innerWidth(), $board.innerHeight());

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
			'$timeout',
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