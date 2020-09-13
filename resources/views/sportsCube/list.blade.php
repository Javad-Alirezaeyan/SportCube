@extends('layouts.master')
@section('title', "Matches")
@section('content')

   @if (empty($items))
       <h5>There is nothing to show</h5>
   @else
       <?php $key=1; ?>
       @foreach ($items as $date=>$matches)
           <div class="my-3 p-3 bg-white  rounded box-shadow">
               <h4 class="border-bottom  border-gray pb-2 mb-0">{{ $date }}</h4>
               <ul class="list-group">
                   @for ($i = 0; $i < min(3, count($matches) ); $i++)
                       <?php $match = $matches[$i]  ?>
                       <li class="list-group-item ">
                           <div class="font-weight-bold">
                               {{ $match['kickoffTime'] }}
                           </div>
                           <div class="text-center">
                               <span  style="margin-right: 50px">
                                   <img src="{{$match['homeTeam']['image']}}"/>
                                   {{  $match['homeTeam']['fullName'] }}
                               </span>
                               <span>
                                   {{ $match['awayTeam']['fullName'] }}
                                   <img src="{{$match['awayTeam']['image']}}"/>
                               </span>
                           </div>
                           <div>
                               {{ $match['competitions']['country']['name'] }} - {{ $match['competitions']['name'] }}
                           </div>
                       </li>
                   @endfor

                   <div  id="{{ $key  }}" style="display: none">
                       @for ($i = 3; $i < count($matches); $i++)
                           <?php $match = $matches[$i] ?>
                           <li class="list-group-item ">
                               <div class="font-weight-bold">
                                   {{ $match['kickoffTime'] }}
                               </div>
                               <div class="text-center">
                               <span  style="margin-right: 50px">
                                   <img src="{{$match['homeTeam']['image']}}"/>
                                   {{  $match['homeTeam']['fullName'] }}
                               </span>
                                   <span>
                                   {{ $match['awayTeam']['fullName'] }}
                                   <img src="{{$match['awayTeam']['image']}}"/>
                               </span>
                               </div>
                               <div>
                                   {{ $match['competitions']['country']['name'] }} - {{ $match['competitions']['name'] }}
                               </div>
                           </li>
                       @endfor
                   </div>
                       <div class="text-center" style="margin: 10px">
                           <span onclick="toggleMatches({{ $key++  }})" style="cursor: pointer; color: blue;">Load more</span>
                       </div>

               </ul>
           </div>
       @endforeach
   @endif
@endsection
<script>
    function toggleMatches(id){
        $("#"+id).slideToggle();
    }
</script>