<div class="login-main">
    <form class="theme-form" wire:submit="login">
        @csrf
        <h4>Sign in to account</h4>
        <p>Enter your username & password to login</p>
        <div class="form-group">
            <label class="col-form-label">Username</label>
            <input
                wire:model="username"
                class="form-control"
                type="text"
                placeholder=""
            />
        </div>
        <div class="form-group">
            <label class="col-form-label">Password</label>
            <div class="form-input position-relative">
                <input
                    wire:model="password"
                    class="form-control"
                    type="password"
                    name="login[password]"
                    placeholder="*********"
                />
                <div class="show-hide"><span class="show"> </span></div>
            </div>
        </div>
        <div class="form-group mb-0">
            <div class="checkbox p-0">
                <input id="checkbox1" type="checkbox" />
                <label class="text-muted" for="checkbox1"
                    >Remember password</label
                >
            </div>
            <div class="text-end mt-3">
                <button
                    class="btn btn-primary btn-block w-100"
                    type="submit"
                    wire:target="login"
                >
                    Sign in
                </button>
            </div>
        </div>
    </form>
</div>
