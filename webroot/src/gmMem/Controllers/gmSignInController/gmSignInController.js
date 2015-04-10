goog.provide('gmMem.Controllers.gmSignInController');
goog.require('gmMem.Controllers');

/**
 * @name gmMem.Controllers.gmSignInScope
 * @extends ng.IScope
 *
 * @property {{provider:string}} model
 *
 */

/**
 * @name gmMem.Controllers.gmSignInController
 *
 * @param {gmMem.Controllers.gmSignInScope} $scope
 *
 * @constructor
 */
gmMem.Controllers.gmSignInController = function($scope)
{
	this._$scope = $scope;
	this._$scope.model = {
		provider: ''
	};
};

/**
 * @returns {boolean}
 */
gmMem.Controllers.gmSignInController.prototype.Submit = function()
{
	return true;
};

gmMem.Angular.controller('gmSignInController', [
	'$scope',
	gmMem.Controllers.gmSignInController
]);