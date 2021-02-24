@extends('layouts/contentLayoutMaster')

@section('title', 'Usuários')

@section('content')
  <!-- Kick start -->
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">Administração</h4>
    </div>
    <div class="card-body">
      <div class="card-text">
        <div class="table-responsive">
          <table class="table">
            <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nome</th>
              <th scope="col">Status</th>
              <th scope="col">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $target)
              <tr>
                <th scope="row">
                  <img
                    src="{{ $target->avatar }}"
                    class="rounded mr-50"
                    alt="profile image"
                    height="40"
                    width="40"
                  />
                </th>
                <td>{{ $target->name }}</td>
                <td>
                  @if($target->active)
                    <div class="badge badge-success">
                      Ativado
                    </div>
                  @else
                    <div class="badge badge-warning">
                      Desativado
                    </div>
                  @endif
                </td>
                <td>
                  <a class="btn"
                     href="{{ route('dashboard.users.edit', ['user' => $target->id]) }}">
                    <i data-feather="edit"></i>
                  </a>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>

        <div class="m-auto">
          {{ $users->links('vendor.pagination.bootstrap-4') }}
        </div>
      </div>
    </div>
  </div>

@endsection
