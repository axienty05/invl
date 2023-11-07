<th class="text-center align-middle" wire:click="setSortBy('{{ $name }}')">
    <button type="button" class="btn btn-icon">
        {{ $displayName }}
        @if ($sortBy !== $name)
        <span class='tf-icons bx bx-expand-vertical'></span>

        @elseif ($sortDir === 'ASC' )
        <span class="tf-icons bx bx-chevron-up"></span>
        @else

        <span class="tf-icons bx bx-chevron-down"></span>
        @endif
    </button>
</th>
