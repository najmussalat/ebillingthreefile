

            <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">accessibility</i>
          <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
            required autocomplete="caddress" autofocus>
          <label for="name" class="center-align">Full Name *</label>
          @error('name')
          <small class="red-text ml-10" role="alert">
            {{ $message }}
          </small>
          @enderror
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">person_outline</i>
          <input id="username" type="text" class="@error('username') is-invalid @enderror" name="username" value="{{ old('username') }}"
            required autocomplete="username" autofocus>
          <label for="name" class="center-align">Username</label>
          @error('username')
          <small class="red-text ml-10" role="alert">
            {{ $message }}
          </small>
          @enderror
        </div>
      </div> 
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">phone</i>
          <input id="phone" type="number" class="@error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"
            required autocomplete="phone" autofocus>
          <label for="name" class="center-align">Phone *</label>
          @error('phone')
          <small class="red-text ml-10" role="alert">
            {{ $message }}
          </small>
          @enderror
        </div>
      </div> 
    
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">mail_outline</i>
          <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email"
            value="{{ old('email') }}" required autocomplete="email">
          <label for="email">Email</label>
          @error('email')
          <small class="red-text ml-10" role="alert">
            {{ $message }}
          </small>
          @enderror
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">lock_outline</i>
          <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required
            autocomplete="new-password">
          <label for="password">Password</label>
          @error('password')
          <small class="red-text ml-10" role="alert">
            {{ $message }}
          </small>
          @enderror
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">lock_outline</i>
          <input id="password-confirm" type="password" name="confirm" required
            autocomplete="new-password">
          <label for="password-confirm">Password again</label>
        </div>
      </div>
      
    