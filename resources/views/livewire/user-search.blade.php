<div>
<div class="container">
            <div class="tables">
                <div>
                @can('owner')
                
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Хэрэглэгчид</div>

                            <div class="card-body" >
                            

                                    <div class="w-1/6 mx-1 pb-3">
                                        <input wire:model.debounce.300ms = "searchname" type="text" placeholder = "Овог" class = "textfield">
                                        <input wire:model.debounce.300ms = "searchlastname" type="text" placeholder = "Нэр" class = "textfield">
                                        <input wire:model.debounce.300ms = "searchreg" type="text" placeholder = "Регистр" class = "textfield">
                                        <select wire:model ="searchtype" class = "textfield">
                                        <option value="">Бүгд</option>
                                        <option value="Шинэ жолоочийн сургалт">Шинэ жолоочийн сургалт</option>
                                        <option value="Ангилал ахиулах сургалт">Ангилал ахиулах сургалт</option>
                                        </select>
                                        <select wire:model="perPage" class = "textfield">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        </select>
                                    </div>
                            
                                
                            <div class="table-responsive" style="overflow-x:auto;">
                                <table class="table" >
                                
                                    <thead>
                                    
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Овог</th>
                                        <th scope="col">Нэр</th>
                                        <th scope="col">Регистр</th>
                                        <th scope="col">Салбар</th>
                                        <th scope="col">Сургалтын төрөл</th>
                                        <th scope="col">Цахим хаяг</th>
                                        <th scope="col">Бүртгүүлсэн огноо</th>
                                        <th scope="col">Үйлдэл</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $number = 1; ?>
                                    @foreach($users as $index => $user)
                                            @if(Auth::user() != $user && $user->role != "admin")
                                            <tr >
                                                <th> {{ $number  }}</th>
                                                <?php $number++; ?>
                                                <th scope="row">{{ $user->id }}</th>
                                                <td>{{ $user->lastname }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->register }}</td>
                                                <td>{{ $user->branch }}</td>
                                                <td>{{ $user->lesson_type }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td >{{ date("d M Y", strtotime($user->created_at)) }}</td>

                                                <td style = "display: flex; align-items: center">
                                                @can('owner')
                                                <a href="{{ route('admin.users.edit', $user->id) }}">
                                                    <span class="material-icons">edit</span>
                                                </a>
                                                @endcan 
                                                  
                                                    @can('owner')
                                                    @if($user != Auth::user())
                                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="float-left" onsubmit = "return confirm('Хэрэглэгчийг устгах уу?')">
                                                            @csrf
                                                            {{ method_field('DELETE') }}
                                                            <button type="submit" class="btn" >
                                                            <span class="material-icons">
                                                            delete
                                                            </span>
                                                            </button>
                                                            
                                                        </form>
                                                        @endif
                                                    @endcan
                                                    @if($user != Auth::user())
                                                    <a data-toggle="collapse" href="#more{{ $user->id }}" role="button" aria-expanded="false" aria-controls="{{ $user->id }}">
                                                    <span class="material-icons">
                                                    info
                                                    </span>
                                                    </a>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr class="hide-table-padding" >
                                                <td colspan="12" >
                                                
                                            @if(count($user->hasResults) > 0)
                                                <div id="more{{ $user->id }}" class="collapse" >
                                                
                                                <table>
                                                    <tr>
                                                        <th scope = "col">Эхэлсэн хугацаа</th>
                                                        <th scope = "col">Дууссан хугацаа</th>
                                                        <th scope = "col">Оноо</th>
                                                        <th scope = "col">Үр дүн</th>
                                                    </tr>

                                                    
                                                    
                                                    @foreach($user->hasResults->reverse() as $data)
                                                    @if($loop->iteration <= 10)
                                                    <tr>
                                                    <td>
                                                    {{ $data->start_time }}
                                                    </td>
                                                    <td>
                                                    {{ $data->end_time }}
                                                    </td>
                                                    <td>
                                                    {{ $data->point }}
                                                    </td>
                                                    @if($data->point >= 18)
                                                    <td>
                                                    Тэнцсэн
                                                    </td>
                                                    @else 
                                                    <td>
                                                    Тэнцээгүй
                                                    </td>
                                                    @endif
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                    
                                                        
                                                    
                                                </table>
                                                <table>
                                                <tr>
                                                        <th scope = "col">Тэнцсэн хувь</th>
                                                        <th scope = "col">Нийт</th>
                                                    </tr>
                                                    <tr>

                                                    @php
                                                    $counter = 0;
 
      
  
                                                        for($i = 0; $i < count($user->hasResults); $i++)
                                                        {
                                                            if($user->hasResults[$i]->point >= 18)
                                                            {
                                                
                                                                $counter++;
                                                            }
                                                        }
                                                        @endphp
                                                        @if(count($user->hasResults) > 0)
                                                  <td scope = "col">{{ number_format(floor($counter / count($user->hasResults) * 100*100)/100,2, '. ', '')  }} %</td>
                                                        <td scope = "col">{{ count($user->hasResults) }}</td>
                                                        @endif
                                                    </tr>
                                                </table>
                                                </div>
                                                @endif
                                                </td>
                                                </tr>
                                                
                                            
                                            </div>
                                            @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                               
                            </div>
                        </div>


                    </div>
                </div>
            
            @endcan

                    @can('admin')
               
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">{{ Auth::user()->branch}} хэрэглэгчид </div>

                                    

                                    <div class="card-body">
                                        <table class="table" style="overflow-x:auto;">

                                        <div class="w-1/6 mx-1">
                                        <input wire:model.debounce.300ms = "searchname" type="text" placeholder = "Овог">
                                        <input wire:model.debounce.300ms = "searchlastname" type="text" placeholder = "Нэр">
                                        <input wire:model.debounce.300ms = "searchreg" type="text" placeholder = "Регистр">
                                        <select wire:model ="searchtype">
                                        <option value="">Бүгд</option>
                                        <option value="Шинэ жолоочийн сургалт">Шинэ жолоочийн сургалт</option>
                                        <option value="Ангилал ахиулах сургалт">Ангилал ахиулах сургалт</option>
                                        </select>
                                        <select wire:model="perPage">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        </select>
                                        </div>

                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">ID</th>
                                                <th scope="col">Овог</th>
                                                <th scope="col">Нэр</th>
                                                <th scope="col">Регистр</th>
                                                <th scope="col">Сургалтын төрөл</th>
                                                <th scope="col">Цахим хаяг</th>
                                                <th scope="col">Бүртгүүлсэн огноо</th>
                                                <th scope="col">Үйлдэл</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $number = 1; ?>
                                            @foreach($users as $index => $user)
                                            @if(Auth::user() != $user && $user->role != "admin" && $user->role != "owner")
                                                    <tr>
                                                        <th>{{$number}}</th>
                                                        <?php $number++; ?>
                                                        <th scope="row">{{ $user->id }}</th>
                                                        <td>{{ $user->lastname }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->register }}</td>
                                                        <td>{{ $user->lesson_type }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ date("d M Y", strtotime($user->created_at)) }}</td>

                                                        <td style = "display: flex; align-items: center">
                                                
                                                <a href="{{ route('admin.users.edit', $user->id) }}">
                                                    <span class="material-icons">edit</span>
                                                </a>
                                              
                                                  
                                                  
                                                    @if($user != Auth::user())
                                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="float-left" onsubmit = "return confirm('Хэрэглэгчийг устгах уу?')">
                                                            @csrf
                                                            {{ method_field('DELETE') }}
                                                            <button type="submit" class="btn">
                                                            <span class="material-icons">
                                                            delete
                                                            </span>
                                                            </button>
                                                            
                                                        </form>
                                                      
                                                  
                                               
                                                    <a href="#more{{ $user->id }}" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="{{ $user->id }}" >
                                                    <span class="material-icons">
                                                    info
                                                    </span>
                                                    </a>
                                                </td>
                                                    </tr>
                                                @endif
                                                <tr class="hide-table-padding">
                                                <td colspan="12">
                                                @if(count($user->hasResults) > 0)
                                                <div id="more{{ $user->id }}" class="collapse">
                                                
                                                <table>
                                                    <tr>
                                                        <th scope = "col">Эхэлсэн хугацаа</th>
                                                        <th scope = "col">Дууссан хугацаа</th>
                                                        <th scope = "col">Оноо</th>
                                                        <th scope = "col">Үр дүн</th>
                                                    </tr>

                                                    
                                                    
                                                    @foreach($user->hasResults as $data)
                                                    @if($loop->iteration <= 10)
                                                    <tr>
                                                    <td>
                                                    {{ $data->start_time }}
                                                    </td>
                                                    <td>
                                                    {{ $data->end_time }}
                                                    </td>
                                                    <td>
                                                    {{ $data->point }}
                                                    </td>
                                                    @if($data->point >= 18)
                                                    <td>
                                                    Тэнцсэн
                                                    </td>
                                                    @else 
                                                    <td>
                                                    Тэнцээгүй
                                                    </td>
                                                    @endif
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                    
                                                        
                                                    
                                                </table>
                                                <table>
                                                <tr>
                                                        <th scope = "col">Тэнцсэн хувь</th>
                                                        <th scope = "col">Нийт</th>
                                                    </tr>
                                                    <tr>

                                                    @php
                                                    $counter = 0;
 
      
  
                                                        for($i = 0; $i < count($user->hasResults); $i++)
                                                        {
                                                            if($user->hasResults[$i]->point >= 18)
                                                            {
                                                
                                                                $counter++;
                                                            }
                                                        }
                                                        @endphp
                                                        @if(count($user->hasResults) > 0)
                                                  <td scope = "col">{{ number_format(floor($counter / count($user->hasResults) * 100*100)/100,2, '. ', '')  }} %</td>
                                                        <td scope = "col">{{ count($user->hasResults) }}</td>
                                                        @endif
                                                    </tr>
                                                </table>
                                                </div>
                                                @endif
                                                </td>
                                                </tr>

                                            
                                            </div>
                                            @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                        
                                        </div>
                                </div>


                            </div>
                            @endcan
                            {!! $users->links() !!}
                        </div>
                        
                </div>
                
            </div>
            
        </div>
