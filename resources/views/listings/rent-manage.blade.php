<x-book-layout>
    <x-book-card class="p-10">
        <header>
            <h1
                class="text-3xl text-center font-bold my-6 uppercase"
            >
                Manage Rents
            </h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
                @unless($rentsGonaManaged->isEmpty())
                    <?php //dd($listingsValues);?>
                    @foreach($rentsGonaManaged as $rent)
                    <tr class="border-gray-300">
                        <td
                            class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                        >
                            <a href="/books/{{$rent->id_book}}">
                                {{$rent->b_name_}}
                            </a>
                        </td>
                        <td
                            class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                        >
                            {{$rent->remainingDays}}
                            
                        </td>
                        
                        <td
                            class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                        >
                            <form method="POST" action="/books/rent/return/{{$rent->r_id}}">
                                @csrf                               
                                <button type="submit" class="text-red-500">
                                    <i class="fa-solid fa-trash"></i
                                    >Return</button
                                >
                            </form>
                        </td>
                    </tr>
                @endforeach
                @else
                <tr class ="border-gray-300">
                    <td
                        class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                    >
                        <p class="text-center">
                            No listings found.
                        </p>
                    </td>
                </tr>
                @endunless

            </tbody>
        </table>
    </x-book-card>
</x-book-layout>