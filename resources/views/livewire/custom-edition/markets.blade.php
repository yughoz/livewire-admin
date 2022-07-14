<div>

    <table class="table table-striped table-bordered" style="width:100%">

        <tbody>
            @foreach ($last_flag as $data)
                <tr>
                    <td> {{ $data['email'] }}</td>
                    <td> {{ $data['coin_id'] }}</td>
                    <td> {{ $data['updated_at'] }}</td>
                </tr>
            @endforeach
            
        </tbody>
    </table>
    <div class="container">
            <h1 style="font-size:20pt"></h1>

            <h3>Data Coin > 1% && volume 1B </h3>
            <br>
            <table id="highTbl" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Key</th>
                        <th>Name</th>
                        <th>Last Price</th>
                        <th>Percent</th>
                        <th>volume</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($high as $data)
                        <tr>
                            <td> {{ $data['key'] }}</td>
                            <td> {{ $data['name'] }}</td>
                            <td> {{ $data['last'] }}</td>
                            <td> {{ number_format ($data['difference'],1) }}</td>
                            <td> {{ $data['volume'] }}</td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="container">
            <h1 style="font-size:20pt"></h1>

            <h3>All koin </h3>
            <br>
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Key</th>
                        <th>Name</th>
                        <th>Last Price</th>
                        <th>Percent</th>
                        <th>volume</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_data as $data)
                        <tr>
                            <td> {{ $data['key'] }}</td>
                            <td> {{ $data['name'] }}</td>
                            <td> {{ $data['last'] }}</td>
                            <td> {{ number_format ($data['difference'],1) }}</td>
                            <td> {{ $data['volume'] }}</td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
