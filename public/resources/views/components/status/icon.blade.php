@props(['status'=> ''])
@if( $status == 'PUBLISHED' || $status == \App\Enums\ModelStatusEnum::PUBLISHED )
    <x-icons.bolt data-tippy-content="Published" class="w-8 h-8 px-1 py-1 text-blue-800 bg-blue-200 rounded" />
@elseif( $status == 'DRAFT' || $status == \App\Enums\ModelStatusEnum::DRAFT )
    <x-icons.draft-orders data-tippy-content="Draft" class="w-8 h-8 px-1 py-1 text-yellow-800 bg-yellow-200 rounded" />
@elseif( $status == 'REVIEWED' || $status == \App\Enums\ModelStatusEnum::REVIEWED )
    <x-icons.task-alt data-tippy-content="Reviewed" class="w-8 h-8 px-1 py-1 text-green-800 bg-green-200 rounded" />
@else
    {{ $status }}
@endif