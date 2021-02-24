@extends('layouts.contentLayoutMaster')

@section('title', 'Configurações')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel='stylesheet' href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel='stylesheet' href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
  <!-- account setting page -->
  <section id="page-account-settings">
    <div class="row">
      <!-- left menu section -->
      <div class="col-md-3 mb-2 mb-md-0">
        <ul class="nav nav-pills flex-column nav-left">
          <!-- general -->
          <li class="nav-item">
            <a
              class="nav-link active"
              id="account-pill-general"
              data-toggle="pill"
              href="#account-vertical-general"
              aria-expanded="true"
            >
              <i data-feather="user" class="font-medium-3 mr-1"></i>
              <span class="font-weight-bold">Geral</span>
            </a>
          </li>
          <!-- change password -->
          <li class="nav-item">
            <a
              class="nav-link"
              id="account-pill-password"
              data-toggle="pill"
              href="#account-vertical-password"
              aria-expanded="false"
            >
              <i data-feather="lock" class="font-medium-3 mr-1"></i>
              <span class="font-weight-bold">Mudar senha</span>
            </a>
          </li>
          <!-- information -->
          <li class="nav-item">
            <a
              class="nav-link"
              id="account-pill-info"
              data-toggle="pill"
              href="#account-vertical-info"
              aria-expanded="false"
            >
              <i data-feather="info" class="font-medium-3 mr-1"></i>
              <span class="font-weight-bold">Informação</span>
            </a>
          </li>
        </ul>
      </div>
      <!--/ left menu section -->

      <!-- right content section -->
      <div class="col-md-9">
        <div class="card">
          <div class="card-body">
            <div class="tab-content">
              <!-- general tab -->
              @if(!is_null($message = session()->get('message')))
                <div class="alert alert-primary" role="alert">
                  <div class="alert-body">
                    {{ $message }}

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                </div>
              @endif

              <div
                role="tabpanel"
                class="tab-pane active"
                id="account-vertical-general"
                aria-labelledby="account-pill-general"
                aria-expanded="true"
              >
                <!-- form -->
                <form class="validate-form mt-2" id="account-form" method="POST"
                      action="{{ route('dashboard.users.update.me') }}">

                @csrf

                <!-- header media -->
                  <div class="media">
                    <a href="javascript:void(0);" class="mr-25">
                      <img
                        src="{{asset('images/portrait/small/avatar-s-11.jpg')}}"
                        id="account-upload-img"
                        class="rounded mr-50"
                        alt="profile image"
                        height="80"
                        width="80"
                      />
                    </a>
                    <!-- upload and reset button -->
                    <div class="media-body mt-75 ml-1">
                      <label for="account-upload" class="btn btn-sm btn-primary mb-75 mr-75">Fazer upload</label>
                      <input type="file" id="account-upload" hidden accept="image/*"/>
                      <p>Permitido JPG, GIF or PNG. Tamanho máximo de 800kB</p>
                    </div>
                    <!--/ upload and reset button -->
                  </div>
                  <!--/ header media -->

                  <div class="row">
                    <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <label for="account-name">Nome</label>
                        <input
                          type="text"
                          class="form-control"
                          id="account-name"
                          name="name"
                          placeholder="Nome"
                          value="{{ $user->name }}"
                        />
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <label for="account-surname">Sobrenome</label>
                        <input
                          type="text"
                          class="form-control"
                          id="account-surname"
                          name="surname"
                          placeholder="Sobrenome"
                          value="{{ $user->surname }}"
                        />
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <label for="account-email">Email</label>
                        <input
                          type="email"
                          class="form-control"
                          id="account-email"
                          name="email"
                          placeholder="Email"
                          value="{{ $user->email }}"
                        />
                      </div>
                    </div>

                    <div class="col-12">
                      <button type="submit" form="account-form" class="btn btn-primary mt-2 mr-1">
                        <i data-feather="save"></i>
                        Salvar alterações
                      </button>
                    </div>
                  </div>
                </form>
                <!--/ form -->
              </div>
              <!--/ general tab -->

              <!-- change password -->
              <div
                class="tab-pane fade"
                id="account-vertical-password"
                role="tabpanel"
                aria-labelledby="account-pill-password"
                aria-expanded="false"
              >
                <!-- form -->
                <form class="validate-form">
                  <div class="row">
                    <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <label for="account-old-password">Senha antiga</label>
                        <div class="input-group form-password-toggle input-group-merge">
                          <input
                            type="password"
                            class="form-control"
                            id="account-old-password"
                            name="password"
                            placeholder="Senha antiga"
                          />
                          <div class="input-group-append">
                            <div class="input-group-text cursor-pointer">
                              <i data-feather="eye"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <label for="account-new-password">Senha nova</label>
                        <div class="input-group form-password-toggle input-group-merge">
                          <input
                            type="password"
                            id="account-new-password"
                            name="new-password"
                            class="form-control"
                            placeholder="Senha nova"
                          />
                          <div class="input-group-append">
                            <div class="input-group-text cursor-pointer">
                              <i data-feather="eye"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <label for="account-retype-new-password">Confirmar senha nova</label>
                        <div class="input-group form-password-toggle input-group-merge">
                          <input
                            type="password"
                            class="form-control"
                            id="account-retype-new-password"
                            name="confirm-new-password"
                            placeholder="Senha nova"
                          />
                          <div class="input-group-append">
                            <div class="input-group-text cursor-pointer"><i data-feather="eye"></i></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button type="submit" class="btn btn-primary mr-1 mt-1">
                        <i data-feather="save"></i>
                        Salvar alterações
                      </button>
                    </div>
                  </div>
                </form>
                <!--/ form -->
              </div>
              <!--/ change password -->

              <!-- information -->
              <div
                class="tab-pane fade"
                id="account-vertical-info"
                role="tabpanel"
                aria-labelledby="account-pill-info"
                aria-expanded="false"
              >
                <form id="account-refresh-form" method="POST"
                      action="{{ route('dashboard.configurations.refresh.me')  }}">
                  @csrf
                </form>

                <!-- form -->
                <form class="validate-form" method="POST" action="{{ route('dashboard.configurations.update.me') }}">
                  <div class="row">
                    <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <label for="account-conv-per-user">Conversões por usuário</label>
                        <input
                          type="number"
                          min="1"
                          class="form-control"
                          name="conv-per-user"
                          id="account-conv-per-user"
                          placeholder="Conversões por usuário"
                          value="{{ $user->configuration->conv_per_user }}"
                        />
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <label for="account-code">Código</label>
                        <input
                          type="text"
                          class="form-control"
                          name="code"
                          disabled
                          id="account-code"
                          placeholder="Seu código"
                          value="{{ $user->configuration->code }}"
                        />
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <label for="account-pix">PIX</label>
                        <input
                          type="text"
                          class="form-control"
                          name="pix"
                          id="account-pix"
                          placeholder="Seu pix"
                          value="{{ $user->configuration->pix }}"
                        />
                      </div>
                    </div>

                    <div class="col-12">
                      <button type="submit" class="btn btn-primary mt-1 mr-1">
                        <i data-feather="save"></i>
                        Salvar alterações
                      </button>
                      <button form="account-refresh-form" type="submit" class="btn btn-warning mt-1 mr-1">
                        <i data-feather="refresh-ccw"></i> Atualizar código
                      </button>
                    </div>
                  </div>
                </form>
                <!--/ form -->
              </div>
              <!--/ information -->

            </div>
          </div>
        </div>
      </div>
      <!--/ right content section -->
    </div>
  </section>
  <!-- / account setting page -->
@endsection

@section('vendor-script')
  <!-- vendor files -->
  {{-- select2 min js --}}
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  {{--  jQuery Validation JS --}}
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/dropzone.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection

@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/pages/page-account-settings.js')) }}"></script>
@endsection
