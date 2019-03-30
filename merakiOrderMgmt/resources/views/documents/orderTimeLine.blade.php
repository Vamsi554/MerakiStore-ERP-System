@extends('layouts.template')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Order Lifecycle
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <ul class="timeline">
          @foreach ($orderCycle as $cycle)

            <li class="time-label">
                <span class="bg-red">
                  {{ $cycle->logDate }}
                </span>
            </li>

            <li>
              <i class="{{ $cycle->indicativeIcon }}"></i>
              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{ $cycle->logTime }} </span>
                <h3 class="timeline-header">{{ $cycle->subject }}</h3>
                <div class="timeline-body">
                  {{ $cycle->content }}
                  <br>
                </div>
                @php
                  $orderStatusLines = $orderStatusUpdates->where('order_status', $cycle->order_status);
                @endphp
                @if(count($orderStatusLines) > 0)
                  <b class="timeline-body"> Status Updates </b>
                  <ul>
                  @foreach ($orderStatusLines as $statusLine)
                      <li> <b> On {{ $statusLine->creation_dttm}}, Mr. {{ $statusLine->user }} Added : </b> {{ $statusLine->comments }}</li> <br>
                  @endforeach
                  </ul>
                @endif
                <div class="timeline-body">
                  @if($cycle->additionalInfo != null)
                    <b>Additional Information : </b> {{ $cycle->additionalInfo }}
                  @endif
                </div>
                @if($cycle->hyperLink AND $cycle->linkDescription)
                  <div class="timeline-footer">
                    <a href="{{ url($cycle->hyperLink) }}" target="_blank" class="btn btn-primary btn-xs">{{ $cycle->linkDescription }}</a>
                  </div>
                @endif
              </div>
            </li>

            @endforeach

            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>

    </section>
  </div>

@endsection
