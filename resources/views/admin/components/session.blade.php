@if (session('success'))
    <div
        class="mb-4 rounded-lg border border-success-300 bg-success-50 px-4 py-3 text-success-700 dark:border-success-800 dark:bg-success-900/30 dark:text-success-300"
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 4000)"
    >
        <div class="flex items-center justify-between">
            <span class="font-medium">
                {{ session('success') }}
            </span>

            <button
                class="text-success-700 hover:text-success-900 dark:text-success-400 dark:hover:text-success-200"
                @click="show = false"
            >
                ✕
            </button>
        </div>
    </div>
@endif
@if (session('error'))
    <div
        class="mb-4 rounded-lg border border-error-300 bg-error-50 px-4 py-3 text-error-700 dark:border-error-800 dark:bg-error-900/30 dark:text-error-300"
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 4000)"
    >
        <div class="flex items-center justify-between">
            <span class="font-medium">
                {{ session('error') }}
            </span>

            <button
                class="text-error-700 hover:text-error-900 dark:text-error-400 dark:hover:text-error-200"
                @click="show = false"
            >
                ✕
            </button>
        </div>
    </div>
@endif
@if (session('warning'))
    <div
        class="mb-4 rounded-lg border border-warning-300 bg-warning-50 px-4 py-3 text-warning-700 dark:border-warning-800 dark:bg-warning-900/30 dark:text-warning-300"
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 4000)"
    >
        <div class="flex items-center justify-between">
            <span class="font-medium">
                {{ session('warning') }}
            </span>

            <button
                class="text-warning-700 hover:text-warning-900 dark:text-warning-400 dark:hover:text-warning-200"
                @click="show = false"
            >
                ✕
            </button>
        </div>
    </div>
@endif
