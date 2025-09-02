<div>
    <form wire:submit.prevent="save" class="flex flex-col gap-4">
        <flux:input
            label="Name"
            type="text"
            wire:model="name"
            placeholder="Enter your name"
        />

        <flux:input
            label="Email"
            type="email"
            wire:model="email"
            placeholder="Enter your email"
        />

        @if (!isset($user->name))
            <flux:input
                label="Password"
                type="password"
                wire:model="password"
                placeholder="Enter your password"
            />

            <flux:input
                label="Confirm Password"
                type="password"
                wire:model="password_confirmation"
                placeholder="Confirm your password"
            />
        @endif

        <flux:button type="submit" variant="primary" color="blue">Save</flux:button>
    </form>
</div>
