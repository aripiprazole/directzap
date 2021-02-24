@extends('layouts/contentLayoutMaster')

@section('title', 'Painel')

@section('content')
<!-- Kick start -->
<div class="card">
  <div class="card-header">
    <h4 class="card-title"></h4>
  </div>
  <div class="card-body">
    <div class="card-text">
      <p>
        Seja bem vindo ao DirectZap! Abaixo você consegue ver os seus links de distribuição.
      </p>

      <div class="alert alert-primary" role="alert">
        <div class="alert-body">
          <strong>Link direto:</strong>
          <a
            class="text-primary"
            href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/documentation/documentation-layouts.html#layout-collapsed-menu"
            target="_blank"
          >
            directzap.com.br/Lorenzo Guimaraes?cod=5322
          </a>
        </div>
      </div>

      <div class="alert alert-primary" role="alert">
        <div class="alert-body">
          <strong>Facebook ads:</strong>
          <a
            class="text-primary"
            href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/documentation/documentation-layouts.html#layout-collapsed-menu"
            target="_blank"
          >
            pageslink.site/Lorenzo Guimaraes?cod=5322
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
