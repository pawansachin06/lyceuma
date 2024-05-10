<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use App\Enums\UserRoleEnum;
use Illuminate\Validation\Rule;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)],
            'username' => ['required', 'string', 'max:255', Rule::unique(User::class)],
            'password' => $this->passwordRules(),
            'phone' => ['required', 'numeric', 'digits:10', Rule::unique(User::class)],
            // 'role' => ['required', new Enum(UserRoleEnum::class) ],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ], [
            'phone.digits' => 'Phone must be valid 10 digits Indian number',
            'phone.unique' => 'Phone number already exists',
            'role.required' => 'Please pick if you are student or teacher'
        ])->validate();

        if (!empty($input['role']) && in_array($input['role'], UserRoleEnum::toArray())) {
            if (in_array($input['role'], [
                UserRoleEnum::SUPERADMIN, UserRoleEnum::ADMIN, UserRoleEnum::EDITOR
            ])) {
                $input['role'] = UserRoleEnum::STUDENT;
            }
        } else {
            $input['role'] = UserRoleEnum::STUDENT;
        }

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'role' => $input['role'],
                'phone' => $input['phone'],
                'username' => $input['username'],
                'password' => Hash::make($input['password']),
            ]), function (User $user) {
                $this->createTeam($user);
            });
        });
    }

    /**
     * Create a personal team for the user.
     */
    protected function createTeam(User $user): void
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0] . "'s Team",
            'personal_team' => true,
        ]));
    }
}
