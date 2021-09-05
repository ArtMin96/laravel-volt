<?php

namespace App\Classes\RecentSearches;

use App\Classes\RecentSearches\Exceptions\CouldNotHasRecentSearches;
use Closure;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Config\Repository;

class UserResolver
{
    protected AuthManager $authManager;

    protected string $authDriver;

    protected Closure | null $resolverOverride = null;

    protected Model | null $userOverride = null;

    public function __construct(Repository $config, AuthManager $authManager)
    {
        $this->authManager = $authManager;

        $this->authDriver = $config['recent-searches']['default_auth_driver'] ?? $this->authManager->getDefaultDriver();
    }

    public function resolve(Model | int | string | null $subject = null): ?Model
    {
        if ($this->userOverride !== null) {
            return $this->userOverride;
        }

        if ($this->resolverOverride !== null) {
            $resultUser = ($this->resolverOverride)($subject);

            if (! $this->isResolvable($resultUser)) {
                throw CouldNotHasRecentSearches::couldNotDetermineUser($resultUser);
            }

            return $resultUser;
        }

        return $this->getUser($subject);
    }

    protected function resolveUsingId(int | string $subject): Model
    {
        $guard = $this->authManager->guard($this->authDriver);

        $provider = method_exists($guard, 'getProvider') ? $guard->getProvider() : null;
        $model = method_exists($provider, 'retrieveById') ? $provider->retrieveById($subject) : null;

        throw_unless($model instanceof Model, CouldNotHasRecentSearches::couldNotDetermineUser($subject));

        return $model;
    }

    protected function getUser(Model | int | string | null $subject = null): ?Model
    {
        if ($subject instanceof Model) {
            return $subject;
        }

        if (is_null($subject)) {
            return $this->getDefaultUser();
        }

        return $this->resolveUsingId($subject);
    }

    /**
     * Override the resolver using callback.
     */
    public function resolveUsing(Closure $callback): static
    {
        $this->resolverOverride = $callback;

        return $this;
    }

    /**
     * Override default user.
     */
    public function setUser(?Model $user): static
    {
        $this->userOverride = $user;

        return $this;
    }

    protected function isResolvable(mixed $model): bool
    {
        return $model instanceof Model || is_null($model);
    }

    protected function getDefaultUser(): ?Model
    {
        return $this->authManager->guard($this->authDriver)->user();
    }
}
