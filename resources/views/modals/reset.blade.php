<!-- Reset Password Modal -->
<div id="resetPasswordModal" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">
            
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
                      
                <h4 class="text-muted">{{ trans('login.reset') }}</h4>

            </div>

            <div class="modal-body">

                <form class="form-horizontal" role="form" method="POST" action="/password/reset">
                    {{ csrf_field() }}

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                     <!--  <label for="email" class="col-md-4 control-label">E-Mail Adresa</label> -->

                     <div class="col-md-6 col-md-offset-3">

                        <div class="input-group">

                            <span class="input-group-addon">

                                <i class="fa fa-envelope-o" aria-hidden="true"></i>

                            </span>

                            <input id="email" type="email" class="form-control formField input-lg" name="email" value="{{ $email or old('email') }}"  autofocus placeholder="E-Mail Adresa">

                        </div>

                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <!-- <label for="password" class="col-md-4 control-label">Lozinka</label> -->

                    <div class="col-md-6 col-md-offset-3">

                        <div class="input-group">

                            <span class="input-group-addon">

                                <i class="fa fa-key" aria-hidden="true"></i>

                            </span>

                            <input id="password" type="password" class="form-control formField input-lg" name="password"  placeholder="Lozinka">

                        </div>

                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <!-- <label for="password-confirm" class="col-md-4 control-label">Ponovi lozinku</label> -->
                    <div class="col-md-6 col-md-offset-3">

                        <div class="input-group">

                            <span class="input-group-addon">

                                <i class="fa fa-key" aria-hidden="true"></i>

                            </span>

                            <input id="password-confirm" type="password" class="form-control formField input-lg" name="password_confirmation"  placeholder="Ponovi Lozinku">

                        </div>

                        @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <button type="submit" class="btn btn-primary btn-block formBtn">
                            Reset Password
                        </button>
                    </div>
                </div>

            </form>

            </div>

        </div> <!-- modal content -->

    </div>

</div>