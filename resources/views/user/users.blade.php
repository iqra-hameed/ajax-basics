@extends('main_body')
@section('main_section')
    <table class="table table-bordered">
        <tr class="pl-4">

            <th class="text-center"> <strong class="text-primary">id</strong></th>
            <th class="text-center"> <strong class="text-primary">Name </strong></th>
            <th class="text-center"> <strong class="text-primary">Email </strong></th>


        </tr>
        @foreach ($users as $user)
            <tr>
                <th scope="row" class="text-center">{{ $loop->iteration }}</th>

                <td class="text-center">{{ $user->name }}</td>
                <td class="text-center">{{ $user->email }}</td>
                {{-- <td class="text-center">{{ $user->user->name }}</td>
                <td class="text-center">{{ $user->email }}</td> --}}

                <td>

                </td>
            </tr>
        @endforeach
    </table>
@endsection
