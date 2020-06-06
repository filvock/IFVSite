@extends('admin.layout.index')

@section('content')
    <!-- Main content -->
    <section class="content">
    <!-- Small boxes (Stat box) -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <div class="row">  
      
        <div class="col-lg-3 col-xs-6">        
            <div class="small-box bg-teal">
                <div class="inner">                    
                    <h3 style="font-size:3.5vmax;">Individual   </h3>
                    <p style="font-size:1.5vmax;">Dízimos individuais</p>
                </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="{{route('admin.individual.index')}}" class="small-box-footer">Novas Entradas <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    <!-- /.row (main row) -->
    </div>
      

    </section>
    <!-- /.content -->

 
@endsection