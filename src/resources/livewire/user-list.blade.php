<div>
    <div class="border shadow-sm flex flex-col gap-4">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
            <tr>
                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">ID</th>
                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Name</th>
                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Email</th>
                <th class="px-4 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
            </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
            @forelse ($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">
                        <a href="{{ route('user', ['user' => $user]) }}" class="font-medium text-gray-900 hover:underline">
                            {{ $user->id }}
                        </a>
                    </td>
                    <td class="px-4 py-3">
                        <a href="{{ route('user', ['user' => $user]) }}" class="text-blue-600 hover:underline">
                            {{ $user->name }}
                        </a>
                    </td>
                    <td class="px-4 py-3">
                        <a href="{{ route('user', ['user' => $user]) }}" class="text-blue-600 hover:underline">
                            {{ $user->email }}
                        </a>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-end gap-2">
                            <flux:button
                                color="red"
                                size="sm"
                                wire:click="deleteUser({{ $user->id }})"
                            >
                                Delete
                            </flux:button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-10 text-center text-sm text-gray-500">
                        No users found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
