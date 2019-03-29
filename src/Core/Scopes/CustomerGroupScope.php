<?php

namespace GetCandy\Api\Core\Scopes;

use Auth;
use GetCandy\Api\Core\CandyApi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class CustomerGroupScope extends AbstractScope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $isHub = $this->api->isHubRequest();
        if (! $this->user || ! $this->hasHubRoles || ($this->hasHubRoles && ! $isHub)) {
            $builder->whereHas('customerGroups', function ($q) {
                $q->whereIn('customer_groups.id', $this->groups)->where('visible', '=', true);
            });
        }
    }

    protected function getCustomerGroups()
    {

    }

    /**
     * Remove the scope from the given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function remove(Builder $builder, Model $model)
    {
        dd('hit');
    }
}
