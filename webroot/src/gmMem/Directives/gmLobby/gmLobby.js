goog.provide('gmMem.Directives.gmLobby');
goog.require('gmMem.Directives');

/**
 * @name gmMem.Directives.gmLobbyScope
 * @extends ng.IScope
 *
 * @property {gmMem.Directives.gmLobbyCtrl} ctrl
 * @property {number} game
 * @property {number} interval
 * @property {bool} ready
 * @property {string} state
 * @property {number} player
 * @property {Array.<Object>} players
 */

/**
 * @name gmMem.Directives.gmLobbyCtrl
 *
 * @param {gmMem.Directives.gmLobbyScope} $scope
 * @param {ng.IHttpService} $http
 * @param {ng.IQService} $q
 * @param {ng.IWindowService} $window
 *
 * @constructor
 */
gmMem.Directives.gmLobbyCtrl = function($scope, $http, $q, $window)
{
	this._$scope = $scope;
	this._$http = $http;
	this._$q = $q;
	this._$window = $window;

	this._$scope.ctrl = this;
	this._$scope.ready = false;
	this._$scope.state = 'loading';
	this._$scope.players = [];
	this.canceler = $q.defer();
};

/**
 * Updates the list of players and their status.
 */
gmMem.Directives.gmLobbyCtrl.prototype.update = function()
{
	this.canceler.resolve();
	this.canceler = this._$q.defer();
	this._$http.get('/lobbies/update/' + this._$scope.game, {timeout: this.canceler.promise})
		.success(function(data)
				 {
					 if(_.isArray(data.players))
					 {
						 this._$scope.players = data.players;
					 }
					 if(_.isString(data.starts))
					 {
						 this._$scope.starts = moment(data.starts).diff(moment(),'seconds');
					 }
					 if(this._$scope.state == 'loading')
					 {
						 this._$scope.ready = this.getPlayer().ready;
					 }
					 this._$scope.state = '';
				 }.bind(this));
};

/**
 * Gets the current player from the list.
 *
 * @returns {Object}
 */
gmMem.Directives.gmLobbyCtrl.prototype.getPlayer = function()
{
	return _.find(this._$scope.players, function(player)
		{
			return player.user.id == this._$scope.player;
		}, this) || {ready: false};
};

/**
 * Toggles the ready state for the current player.
 *
 * @param {Event} $event
 */
gmMem.Directives.gmLobbyCtrl.prototype.ready = function($event)
{
	$event.preventDefault();

	this.canceler.resolve();
	if(this._$scope.ready)
	{
		this._$scope.ready = false;
		this._$http.get('/lobbies/unready/' + this._$scope.game);
	}
	else
	{
		this._$scope.ready = true;
		this._$http.get('/lobbies/ready/' + this._$scope.game);
	}

	this.getPlayer().ready = this._$scope.ready;
};

/**
 * Called when the timer has run out.
 */
gmMem.Directives.gmLobbyCtrl.prototype.play = function()
{
	console.log('game is starting!');
	this._$window.location.href = '/games/play/'+this._$scope.game;
};

/**
 * @param {ng.IIntervalService} $interval
 *
 * @returns {ng.IDirective}
 */
gmMem.Directives.gmLobby = function($interval)
{
	/**
	 * @param {gmMem.Directives.gmLobbyScope} $scope
	 * @param {JQuery} $el
	 * @param {ng.IAttributes} $attr
	 * @param {gmMem.Directives.gmLobbyCtrl} ctrl
	 * @private
	 */
	function _link($scope, $el, $attr, ctrl)
	{
		ctrl.update();

		$interval(function()
				  {
					  ctrl.update();
				  }, $scope.interval || 1000);
	}

	return {
		restrict:    'EA',
		scope:       {
			'game':     '@',
			'interval': '@',
			'player':   '@'
		},
		link:        _link,
		controller:  [
			'$scope',
			'$http',
			'$q',
			'$window',
			gmMem.Directives.gmLobbyCtrl
		],
		templateUrl: '/src/gmMem/Directives/gmLobby/gmLobby.html'
	}
};

gmMem.Angular.directive('gmLobby', [
	'$interval',
	gmMem.Directives.gmLobby
]);