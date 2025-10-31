@php
use Illuminate\Support\Facades\Storage;
@endphp

<div class="Portfolio__container bd-grid">
    @if(!empty($projects) && $projects->count())
        @foreach($projects as $project)
            <div class="Portfolio__item">
                <a href="#" class="Portfolio__img" data-modal-target="#modal-{{ $project->id }}">
                    @php
                        $img = $project->images[0] ?? null;
                        if ($img && filter_var($img, FILTER_VALIDATE_URL)) {
                            $url = $img;
                        } elseif ($img && Storage::disk('public_project')->exists($img)) {
                            $url = Storage::disk('public_project')->url($img);
                        } elseif ($img && file_exists(public_path($img))) {
                            $url = asset($img);
                        } elseif ($img && Storage::disk('public')->exists($img)) {
                            $url = Storage::disk('public')->url($img);
                        } else {
                            $url = asset('images/work1.jpg');
                        }
                    @endphp
                    <img src="{{ $url }}" alt="{{ $project->title }}">
                    <div class="Portfolio__text">{{ $project->title }}
                        @if($project->subtitle)
                            <span class="Portfolio__subtext">{{ $project->subtitle }}</span>
                        @endif
                    </div>
                </a>
            </div>
        @endforeach
    @else
        <p>Tidak ada proyek untuk ditampilkan.</p>
    @endif
</div>

{{-- Custom pagination (single set) --}}
@if($projects->hasPages())
    <div class="portfolio-pagination">
        <nav aria-label="Portfolio pagination">
            <ul>
                <li class="{{ $projects->onFirstPage() ? 'disabled' : '' }}">
                    @if(!$projects->onFirstPage())
                        <a href="{{ route('home', ['page' => $projects->currentPage()-1]) }}#Portfolio" data-page="{{ $projects->currentPage()-1 }}" rel="prev">&laquo; Prev</a>
                    @else
                        <span>&laquo; Prev</span>
                    @endif
                </li>

                @foreach(range(1, $projects->lastPage()) as $page)
                    <li class="{{ $page == $projects->currentPage() ? 'active' : '' }}">
                        @if($page == $projects->currentPage())
                            <span aria-current="page">{{ $page }}</span>
                        @else
                            <a href="{{ route('home', ['page' => $page]) }}#Portfolio" data-page="{{ $page }}">{{ $page }}</a>
                        @endif
                    </li>
                @endforeach

                <li class="{{ $projects->hasMorePages() ? '' : 'disabled' }}">
                    @if($projects->hasMorePages())
                        <a href="{{ route('home', ['page' => $projects->currentPage()+1]) }}#Portfolio" data-page="{{ $projects->currentPage()+1 }}" rel="next">Next &raquo;</a>
                    @else
                        <span>Next &raquo;</span>
                    @endif
                </li>
            </ul>
        </nav>
    </div>
@endif

{{-- Modals for projects on this page --}}
@if(!empty($projects) && $projects->count())
    @foreach($projects as $project)
        <div class="modal" id="modal-{{ $project->id }}">
            <div class="modal-content">
                <span class="modal-close">&times;</span>
                <h2>{{ $project->title }}</h2>
                @if($project->subtitle)
                    <h3>{{ $project->subtitle }}</h3>
                @endif

                @if($project->description)
                    <p>{{ $project->description }}</p>
                @endif

                @if($project->tools)
                    <p><strong>Tools:</strong> {{ $project->tools }}</p>
                @endif

                @if($project->link)
                    <p class="modal__link">Link: <a href="{{ $project->link }}" target="_blank">Kunjungi</a></p>
                @endif

                @if(!empty($project->images) && is_array($project->images))
                    <div class="modal-images">
                        @foreach($project->images as $img)
                            @php
                                if (filter_var($img, FILTER_VALIDATE_URL)) {
                                    $iurl = $img;
                                } elseif (Storage::disk('public_project')->exists($img)) {
                                    $iurl = Storage::disk('public_project')->url($img);
                                } elseif (file_exists(public_path($img))) {
                                    $iurl = asset($img);
                                } elseif (Storage::disk('public')->exists($img)) {
                                    $iurl = Storage::disk('public')->url($img);
                                } else {
                                    $iurl = asset('images/work1.jpg');
                                }
                            @endphp
                            <img src="{{ $iurl }}" alt="{{ $project->title }}">
                        @endforeach
                    </div>
                @else
                    <img src="{{ asset('images/work1.jpg') }}" alt="{{ $project->title }}">
                @endif
            </div>
        </div>
    @endforeach
@endif
