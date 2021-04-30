<div>
<div class = "container">
            <div class="col-md-18">
                <div class="card">
                    <div class="card-header">
                        Асуултууд
                    </div>
                    <div class="card-body">
                    <div class="w-1/8 mx-1 pb-3">
                                        <select wire:model ="searchtype" class = "textfield">
                                        <option value="">Бүгд</option>
                                        <option value="Шинэ жолоочийн сургалт">Шинэ жолоочийн сургалт</option>
                                        <option value="Ангилал ахиулах сургалт">Ангилал ахиулах сургалт</option>
                                        </select>
                                        <input wire:model.debounce.300ms = "searchsub" type="text" placeholder = "Сэдэв" class = "textfield">
                                        <input wire:model.debounce.300ms = "searchques" type="text" placeholder = "Асуулт" class = "textfield">
                                      
                                        <select wire:model="perPage" class = "textfield">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        </select>
                                    </div>
                                    <div class="table-responsive">
                    <table class="table">
                    
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Төрөл</th>
                                                <th scope="col">Сэдэв</th>
                                                <th scope="col">Асуулт</th>
                                                <th scope="col">Зураг</th>
                                                <th scope="col">Хариулт 1</th>
                                                <th scope="col">Хариулт 2</th>
                                                <th scope="col">Хариулт 3</th>
                                                <th scope="col">Хариулт 4</th>
                                                <th scope="col">Хариулт 5</th>
                                                <th scope="col">Хариулт</th>
                                                <th scope="col">Үйлдэл</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $number = 1; ?>
                                            @foreach($questions as $index => $question)
                                            
                                                    <tr>
                                                        <th scope="row">{{ $number }}</th>
                                                        <?php $number++; ?>
                                                        <td>{{ $question->type }}</td>
                                                        <td>{{ $question->sub }}</td>
                                                        <td>{{ $question->question }}</td>
                                                        @if($question->image != "")
                                                        <td><img src="/storage/{{ $question->image }}" alt="" width="100" height="100"></td>
                                                        @else
                                                        <td></td>
                                                        @endif
                                                        <td>{{ $question->option1 }}</td>
                                                        <td>{{ $question->option2 }}</td>
                                                        <td>{{ $question->option3 }}</td>
                                                        <td>{{ $question->option4 }}</td>
                                                        <td>{{ $question->option5 }}</td>
                                                        <td>{{ $question->answer }}</td>
                                                        
                                                        <td style = "display: flex; align-items: center">
                                                        @can('manage-user')
                                                        <a href="{{ route('admin.questions.edit', $question) }}">
                                                            <span class="material-icons">edit</span>
                                                        </a>
                                                
                                                    
                                                        <form action="{{ route('admin.questions.destroy', $question) }}" method="POST" class="float-left" onsubmit = "return confirm('Асуултыг устгах уу?')">
                                                            @csrf
                                                            {{ method_field('DELETE') }}
                                                            <button type="submit" class="btn">
                                                            <span class="material-icons">
                                                            delete
                                                            </span>
                                                            </button>
                                                            
                                                        </form>
                                                    @endcan
                                                    </td>

                                                    </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                        {!! $questions->links() !!}
                    </div>
                </div>
            </div>
        </div>
</div>
