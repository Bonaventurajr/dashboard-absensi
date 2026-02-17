@extends('layouts.app')

@section('title', 'FAQ')

@section('content')
<div class="container-fluid px-0">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card stat-card border-0 shadow-sm">
                <div class="card-body">
                    <h4 class="mb-2">
                        <i class="fas fa-question-circle text-primary me-2"></i>
                        Frequently Asked Questions
                    </h4>
                    <p class="text-muted mb-0">Find answers to common questions</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card stat-card">
        <div class="card-body">
            <div class="accordion" id="faqAccordion">
                @foreach($faqs as $index => $faq)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $index }}">
                        <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" 
                                type="button" data-bs-toggle="collapse" 
                                data-bs-target="#collapse{{ $index }}">
                            {{ $faq['question'] }}
                        </button>
                    </h2>
                    <div id="collapse{{ $index }}" 
                         class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}"
                         data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            {{ $faq['answer'] }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection