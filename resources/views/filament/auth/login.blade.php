<div class="login-grid" style="display: grid; grid-template-columns: 1fr 1fr; min-height: 70vh;">
    <style>
        @media (max-width: 1023px) {
            .login-image-col {
                display: none !important;
            }

            .login-grid {
                grid-template-columns: 1fr !important;
                min-height: 50vh !important;
            }

            .login-form-col {
                margin: 0 !important;
            }
        }
    </style>

    {{-- Left image --}}
    <div class="login-image-col" style="position: relative;">
        <img
            src="{{ asset('images/login-side.svg') }}"
            alt="Login side image"
            style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover;"
        />
        <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.3);"></div>
        <div style="position: relative; z-index: 10; display: flex; height: 100%; align-items: flex-end; padding: 2.5rem; color: white;">
            <div>
                <div style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.1em; opacity: 0.8;">Welcome</div>
                <div style="margin-top: 0.5rem; font-size: 1.875rem; font-weight: 600;">Franchise Core</div>
                <div style="margin-top: 0.5rem; max-width: 28rem; font-size: 0.875rem; opacity: 0.9;">
                    Manage brands, stores, and teams from a single workspace.
                </div>
            </div>
        </div>
    </div>

    {{-- Right login form --}}
    <div class="login-form-col" style="align-self: center; padding: 2.5rem 1.5rem; margin: 0 0 0 2rem;">
        <div class="login-form-container container-lg lg:container-5xl">
            <x-filament-panels::page.simple>
                {{ $this->content }}
            </x-filament-panels::page.simple>
        </div>
    </div>
</div>
