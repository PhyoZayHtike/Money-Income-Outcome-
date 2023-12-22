<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income Outcome</title>
    <link href="https://cdn.jsdelivr.net/npm/argon-design-system-free@1.2.0/assets/css/argon-design-system.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card card-body shadow-sm">

                  @if (session()->has('success'))
                  <div class="alert alert-success">{{session('success')}}</div>
                  @endif

                  @error('about')
                  <div class="alert alert-danger">
                   {{$message}}
                  </div>
                  @enderror

                  @error('amount')
                  <div class="alert alert-danger">
                   {{$message}}
                  </div>
                  @enderror

                  @error('date')
                  <div class="alert alert-danger">
                   {{$message}}
                  </div>
                  @enderror

                    <form action="" method="POST">
                        @csrf
                        <input type="text" class="btn btn-info text-white mt-1" name="about" placeholder="Your content . . ." value="{{old('about')}}">
                        <input type="number" class="btn btn-info text-white mt-1" name="amount" placeholder="Amount . . ." value="{{old('amount')}}">
                        <input type="date" class="btn btn-dark text-white mt-1" name="date" value="{{old('date')}}">
                        <select class="btn btn-dark mt-1" name="type" id="">
                            <option value="In">Income</option>
                            <option value="Out">Outcome</option>
                        </select>
                        <input type="submit" value="Add" class="btn btn-success mt-1">
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                   <ul class="list-group mt-4 shadow-sm">
                    @foreach ($data as $d)
                     <li class="list-group-item d-flex justify-content-between">
                        <div class="">{{$d->about}} <br><small>{{$d->date}}</small></div>
                            @if ($d->type == 'in')
                           <small class="text text-success">
                            + {{$d->amount}}Ks
                           </small>
                           @else
                           <small class="text text-danger">
                            - {{$d->amount}}Ks
                           </small>
                            @endif
                    </li>
                    @endforeach

                   </ul>
                  <div class="d-flex justify-content-center mt-4">
                    {{ $data->links() }}
                  </div>
            </div>
            <div class="col-md-6">
                <div class="card card-body mt-4 shadow-sm">
                <div class="d-flex justify-content-between">
                  <h5>Chart</h5>
                 <div>
                    <div class="text-center"><h6>Today</h6></div>
                    <small class="text-success">Income : +{{$total_income}}</small>
                    <small class="text-danger ml-2">Outcome : -{{$total_outcome}}</small>
                 </div>
                </div>
                <hr class="p-0 m-0">
                 <canvas class="mt-2" id="inout"></canvas>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('inout');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: @json($day_arr),
        datasets: [{
          label: 'Income',
          data: @json($income_amount),
          borderWidth: 1,
          backgroundColor: '#2DCE89'
        },{
          label: 'Outcome',
          data: @json($outcome_amount),
          borderWidth: 1,
          backgroundColor: '#F5365C'
        }
    ]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
</html>
