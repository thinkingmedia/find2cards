goog.provide('gmMem.Directives.gmLobby');
goog.require('gmMem.Directives');

/**
 * @name gmMem.Directives.gmLobbyScope
 * @extends ng.IScope
 *
 * @property {gmMem.Directives.gmLobbyCtrl} ctrl
 * @property {number} game
 * @property {number} interval
 * @property {Array.<Object>} players
 */

/**
 * @name gmMem.Directives.gmLobbyCtrl
 *
 * @param {gmMem.Directives.gmLobbyScope} $scope
 * @param {ng.IHttpService} $http
 *
 * @constructor
 */
gmMem.Directives.gmLobbyCtrl = function($scope, $http)
{
	this._$scope = $scope;
	this._$http = $http;
	this._$scope.ctrl = this;
	this._$scope.players = [];
};

/**
 * @param {number} game
 */
gmMem.Directives.gmLobbyCtrl.prototype.update = function(game)
{
	this._$http.get('/lobbies/update/' + game)
		.success(function(data)
				 {
					 if(_.isArray(data.players))
					 {
						 this._$scope.players = data.players;
					 }
				 }.bind(this));
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
		ctrl.update($scope.game);

		$interval(function()
				  {
					  ctrl.update($scope.game);
				  }, $scope.interval || 1000);
	}

	return {
		restrict:    'EA',
		scope:       {
			'game':     '@',
			'interval': '@'
		},
		link:        _link,
		controller:  [
			'$scope',
			'$http',
			gmMem.Directives.gmLobbyCtrl
		],
		templateUrl: '/src/gmMem/Directives/gmLobby/gmLobby.html'
	}
};

gmMem.Angular.directive('gmLobby', [
	'$interval',
	gmMem.Directives.gmLobby
]);