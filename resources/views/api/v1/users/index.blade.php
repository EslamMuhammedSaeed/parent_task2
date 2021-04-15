@extends('layout.app')

@section('content')

<div class="px-3 py-3">
    
    <form action="/api/v1/users" method="get">
        
        <label class="mr-2" for="provider">Provider</label>

        <select name="provider" id="provider">
            <option value="0"></option>
            @foreach ($avaialableProviders as $availableProvider)
                <option value="{{$availableProvider}}">{{$availableProvider}}</option>
            @endforeach
            
        </select>

        <label class="ml-4 mr-2" for="statusCode">Status</label>

        <select name="statusCode" id="statusCode">
            <option value="0"></option>
            <option value="1">authorised</option>
            <option value="2">decline</option>
            <option value="3">refunded</option>
            
        </select>

        <label class="ml-4" for="balanceMin">balance min:</label>
        <input type="number" name="balanceMin" id="balanceMin" value="0">

        <label class="ml-4" for="balanceMax">balance max:</label>
        <input type="number" name="balanceMax" id="balanceMax" value="1000000">

        <input class="ml-4" type="submit" value="submit">
    </form>
</div>
<div class="mt-3" name="DataProvider">
    <h2>Data</h2>
    <table class="table table-dark table-striped">
        <thead>
          <tr>
            @forelse ($headers as $header)
               <th>{{$header}}</th> 
            @empty
                
            @endforelse
          </tr>
        </thead>
        <tbody>
            @foreach ($merged_content as $merged_content_row)
                <tr>
                    @foreach ($merged_content_row as $merged_content_col) 
                    <td>
                        {{$merged_content_col}}
                    </td>
                    @endforeach  
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


    
@endsection