{{-- <tr class="dark:bg-gray-800">
    <td></td>
    <td class="filament-tables-cell dark:text-white">
        <div class="px-4 py-3 filament-tables-text-column">
            Total:
        </div>
    </td>
    <td>
    </td>
    <td>
    </td>
    <td class="filament-tables-cell dark:text-white">
        <div class="px-4 py-3 filament-tables-text-column">
            ${{ number_format($this->records->sum('cost'), 2) }}

        </div>
    </td>
    <td>
        <div class="total-column" x-data="{
            init: function() {
                $watch('selectedRecords', value => {
                    $wire.getSelectedRecordsTotal(selectedRecords).then(result => {
                        $el.innerHTML = '($' + result + ')';
                    });
                })
            }
        }">($0.00)
        </div>
    </td>
</tr> --}}
