@extends('layouts/contentLayoutMaster')

@section('title', 'Adcionar colaborador')

@section('content')
  <!-- Kick start -->
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">Adcionar novo colaborador</h4>
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('dashboard.collaborators.store') }}">
        @csrf

        <div class="form-group">
          <label for="name">Nome</label>
          <input required name="name" type="text" class="form-control" id="name" placeholder="Jhon">
        </div>

        <div class="form-group">
          <label for="phone">Telefone</label>
          <input required name="phone" type="text" class="form-control" id="phone" placeholder="995535321">
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input required name="email" type="email" class="form-control" id="email" placeholder="jhon.doe@example.com">
        </div>

        <div class="form-group">
          <label for="message">Mensagem</label>
          <input required name="message" type="text" class="form-control" id="message" placeholder="Olá Jhon, vi seu anúncio...">
        </div>

        <button type="submit" class="btn btn-primary">
          Criar colaborador
        </button>
      </form>
    </div>
  </div>
@endsection
