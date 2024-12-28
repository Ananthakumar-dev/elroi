@extends('template.app')

@section('content')
    <div>
        <div>
            <a href="{{ route('students.create') }}" class="border border-gray-700 px-4 py-1">
                Add new student
            </a>
        </div>

        <div>
            @if(!$students->count())
                <h4>No Students Found</h4>
            @else
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Country</th>
                        <th>State</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->country_name }}</td>
                            <td>{{ $student->state_name }}</td>

                            <td>
                                <button class="border border-gray-500 px-4 py-1">
                                    <a href="{{ route('students.show', [ 'studentId' => $student->id ]) }}">Edit</a>
                                </button>
                            </td>

                            <td>
                                <button class="border border-gray-500 px-4 py-1">
                                    <a href="{{ route('students.destroy', [ 'studentId' => $student->id ]) }}" onclick="if(!confirm('Are you sure want to delete?')) return false;">Delete</a>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
@endsection