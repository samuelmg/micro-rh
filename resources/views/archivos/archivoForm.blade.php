@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Importador de Archivo de Checador</div>

                <div class="card-body">
                    @if(isset($error))
                        <div class="alert alert-danger" role="alert">
                            {{ $error }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('importar-post') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-md-4" for="file">Importar Entradas/Salidas:</label>
                            <div class="col-md-6">
                                <input type="file" name="file" accept =".xls, .xlsx, .csv">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                               <button type="submit" class="btn btn-primary">Importar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
