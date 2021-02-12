@extends('frutas.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Prueba</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('frutas.create') }}"> Create New Product</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($frutas as $fruta)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $fruta->name }}</td>
                <td>{{ $fruta->detail }}</td>
                <td>
                    <form action="{{ route('frutas.destroy',$fruta->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('frutas.show',$fruta->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('frutas.edit',$fruta->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $frutas->links() !!}

@endsection
