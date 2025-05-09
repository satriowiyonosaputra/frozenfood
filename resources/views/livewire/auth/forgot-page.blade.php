<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <div class="flex h-full items-center">
    <main class="w-full max-w-md mx-auto p-6">

      <div class="mt-7">
        <!-- Tombol Kembali nempel atas kotak -->
        <div class="mb-3">
          <a href="/login" class="inline-flex items-center px-4 py-2 bg-blue-100 border border-blue-200 rounded-lg shadow-sm text-sm font-medium text-blue-600 hover:bg-blue-50 hover:shadow-md transition-all">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Login
          </a>
        </div>

        <!-- Kotak Form -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-blue-100 dark:border-gray-700">
          <div class="p-4 sm:p-7">
            <div class="text-center">
              <h1 class="block text-2xl font-bold text-gray-800 dark:text-black">Forgot password?</h1>
              <p class="mt-2 text-sm text-gray-600 dark:text-black-400">
                Remember your password?
                <a class="text-blue-600 decoration-2 hover:underline font-medium dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/login">
                  Sign in here
                </a>
              </p>
            </div>

            <div class="mt-5">
              <!-- Form -->
              <form wire:submit.prevent='save'>
                @if (session('success'))
                <div class="mt-2 bg-green-500 text-sm text-white rounded-lg p-4 mb-4" role="alert">
                  {{ session('success') }}
                </div>
                @endif
                <div class="grid gap-y-4">
                  <div>
                    <label for="email" class="block text-sm mb-2 dark:text-black">Email address</label>
                    <input type="email" id="email" wire:model="email"
                           class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-white-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                           aria-describedby="email-error">
                    @error('email')
                    <div class="relative">
                      <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                        <svg class="h-5 w-5 text-red-500" width="16" height="16" fill="currentColor"
                             viewBox="0 0 16 16" aria-hidden="true">
                          <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                        </svg>
                      </div>
                    </div>
                    <p class="text-xs text-red-600 mt-2" id="email-error">{{ $message }}</p>
                    @enderror
                  </div>
                  <br>
                  <button type="submit"
                          class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                    Reset password
                  </button>
                </div>
              </form>
              <!-- End Form -->
            </div>
          </div>
        </div>
        <!-- End Kotak Form -->
      </div>

    </main>
  </div>
</div>
