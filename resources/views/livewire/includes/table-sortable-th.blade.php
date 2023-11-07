<th class=" align-middle" wire:click="setSortBy('{{ $name }}')">
    {{ $displayName }}
    @if ($sortBy !== $name)
    <i class='bx bx-collapse-vertical small'></i>

    @elseif ($sortDir === 'ASC' )
    <i class='bx bx-chevron-up small'></i>
    @else

    <i class='bx bx-chevron-down small'></i>
    @endif
</th>
