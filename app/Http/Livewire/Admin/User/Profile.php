<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use JetBrains\PhpStorm\ArrayShape;
use Livewire\Component;
use Livewire\Redirector;

class Profile extends Component
{
    public User $user;

    public string $currentPassword = '';

    public string $password = '';

    public string $passwordConfirmation = '';

    public string $passwordConfirmationAccountDeletion = '';

    protected function rules(): array
    {
        return collect($this->sectionLevelRules())->collapse()->toArray();
    }

    #[ArrayShape(['profileInfo' => 'array[]', 'updatePassword' => 'array', 'deleteAccount' => 'array[]'])]
    private function sectionLevelRules(): array
    {
        return [
            'profileInfo' => [
                'user.first_name' => ['required', 'string', 'max:255'],
                'user.last_name' => ['required', 'string', 'max:255'],
                'user.email' => ['required', 'email', 'max:255'],
            ],
            'updatePassword' => [
                'currentPassword' => ['required', 'current_password'],
                'password' => ['required', Password::defaults(), 'same:passwordConfirmation'],
            ],
            'deleteAccount' => [
                'passwordConfirmationAccountDeletion' => ['required', 'current_password'],
            ],
        ];
    }

    public function updated(string $propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function saveProfileInformation(): void
    {
        // Validate Rules
        $rules = $this->sectionLevelRules()['profileInfo'];
        $this->validate($rules);

        //Do action
        $this->user->save();

        // Dispatch browser event
        $this->dispatchBrowserEvent('notify', [
            'type' => 'success',
        ]);
    }

    public function saveCredentials(): void
    {
        // Validate Rules
        $rules = $this->sectionLevelRules()['updatePassword'];
        $this->validate($rules);

        // Do action
        $this->user->save([
            'password' => Hash::make($this->password),
        ]);

        // Reset properties
        $this->reset(['password', 'passwordConfirmation', 'currentPassword']);

        // Dispatch browser event
        $this->dispatchBrowserEvent('notify', [
            'type' => 'success',
        ]);
    }

    public function deleteAccount(): RedirectResponse|Redirector
    {
        // Validate Rules
        $rules = $this->sectionLevelRules()['deleteAccount'];
        $this->validate($rules);

        // Do action
        auth()->logout();
        $this->user->delete();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        // Reset properties
        $this->reset(['passwordConfirmationAccountDeletion']);

        // Redirect
        return to_route('login');
    }

    public function mount(): void
    {
        $this->user = auth()->user();
    }

    public function render(): Application|Factory|View
    {
        return view('livewire.admin.user.profile')->layout('layouts.admin', [
            'pageTitle' => 'Profile',
            'pageDesc' => 'This is the dashboard page where we get all stats information.',
        ]);
    }
}
