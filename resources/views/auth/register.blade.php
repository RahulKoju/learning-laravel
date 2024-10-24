<x-layout>
    <x-slot:heading>
        Register
    </x-slot:heading>
    <form method="POST" action="/register">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <x-form-feild>
                        <x-form-label for="name">Name</x-form-label>
                        <div class="mt-2">
                            <x-form-input required name="name" id="name" placeholder="Enter your name" />
                            <x-form-error name="name" />
                        </div>
                    </x-form-feild>

                    <x-form-feild>
                        <x-form-label for="email">Email</x-form-label>
                        <div class="mt-2">
                            <x-form-input required name="email" id="email" placeholder="example@gmail.com" />
                            <x-form-error name="email" />
                        </div>
                    </x-form-feild>

                    <x-form-feild>
                        <x-form-label for="password">Password</x-form-label>
                        <div class="mt-2">
                            <x-form-input required type="password" name="password" id="password" />
                            <x-form-error name="password" />
                        </div>
                    </x-form-feild>

                    <x-form-feild>
                        <x-form-label for="password_confirmation">Confirm password</x-form-label>
                        <div class="mt-2">
                            <x-form-input required type="password" name="password_confirmation" id="password_confirmation" />
                            <x-form-error name="password_confirmation" />
                        </div>
                    </x-form-feild>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
            <x-form-button>Register</x-form-button>
        </div>
    </form>
</x-layout>