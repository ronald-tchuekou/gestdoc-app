<div class="col-lg-4 col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Activités réçentes</h4>
            <a href="/all-activities" class="nav-link btn-link">Voir plus</a>
        </div>
        <div class="card-content">
            <div class="card-body">
                <ul class="activity-timeline timeline-left list-unstyled">

                @foreach($histories as $history)

                    <li>
                        @if($history->action_type == 'Ajout')

                        <div class="timeline-icon bg-primary">
                            <i class="feather icon-plus font-medium-2 align-middle"></i>
                        </div>

                        @elseif($history->action_type == 'Supperssion')

                        <div class="timeline-icon bg-info">
                            <i class="feather icon-trash-2 font-medium-2 align-middle"></i>
                        </div>

                        @elseif($history->action_type == 'Rejet')

                        <div class="timeline-icon bg-danger">
                            <i class="feather icon-x font-medium-2 align-middle"></i>
                        </div>

                        @elseif($history->action_type == 'Validation')

                        <div class="timeline-icon bg-success">
                            <i class="feather icon-check font-medium-2 align-middle"></i>
                        </div>

                        @elseif($history->action_type == 'Modification')

                        <div class="timeline-icon bg-warning">
                            <i class="feather icon-edit-2 font-medium-2 align-middle"></i>
                        </div>

                        @else

                        <div class="timeline-icon bg-info">
                            <i class="feather icon-bookmark font-medium-2 align-middle"></i>
                        </div>

                        @endif

                        <div class="timeline-info">
                            <p class="font-weight-bold mb-0">{{$history->title}}</p>
                            <span class="font-small-3">{{!!$history->content!!}}</span>
                        </div>
                        <small class="text-muted">{{App\Models\Utils::get_time_ago(strtotime($history->created_at))}}</small> par :
                        <small class="text-primary text-bold-700">{{$history->user->personne->nom}} {{$history->user->personne->prenom}}</small>
                    </li>

                @endforeach

                </ul>
            </div>
        </div>
    </div>
</div>
