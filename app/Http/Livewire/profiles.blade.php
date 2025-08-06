<div class="p-4 max-w-3xl mx-auto">
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'save' }}">
        <div class="grid gap-2">
            <input type="text" wire:model="name" placeholder="Name" class="border p-2">
            <input type="email" wire:model="email" placeholder="Email" class="border p-2">
            <input type="text" wire:model="designation" placeholder="Designation" class="border p-2">
        </div>
        <button type="submit" class="mt-2 px-4 py-1 bg-blue-600 text-white rounded">
            {{ $isEdit ? 'Update' : 'Save' }}
        </button>
        @if($isEdit)
            <button type="button" wire:click="resetForm" class="mt-2 px-4 py-1 bg-gray-500 text-white rounded">Cancel</button>
        @endif
    </form>

    <hr class="my-4">

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="p-2">Name</th>
                <th class="p-2">Email</th>
                <th class="p-2">Designation</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($profiles as $profile)
                <tr class="border-t">
                    <td class="p-2">{{ $profile->name }}</td>
                    <td class="p-2">{{ $profile->email }}</td>
                    <td class="p-2">{{ $profile->designation }}</td>
                    <td class="p-2">
                        <button wire:click="edit({{ $profile->id }})" class="text-blue-600">Edit</button>
                        <button wire:click="delete({{ $profile->id }})" class="text-red-600 ml-2">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
