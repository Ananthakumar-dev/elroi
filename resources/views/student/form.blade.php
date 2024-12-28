<form action="" id="studentForm" x-data>
    <section>
        <div class="">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="h-8 border mt-1 rounded px-4 w-[200px] bg-gray-50" value="{{ @$studentDetails->name }}" />

            <p class="text-red-500 error-msg" id="error-name"></p>
        </div>

        <div class="mt-2">
            <label for="country">Country</label>
            <select id="country" name="country_id" class="border px-4 py-2" @change="$store.stateStore.getStates($event)">
                <option value="">Select</option>
                @foreach($basicData['countries'] as $country)
                <option value="{{ $country->id }}" @if(isset($studentDetails) && $studentDetails->country_id == $country->id) selected @endif> {{ $country->name }} </option>
                @endforeach
            </select>

            <p class="text-red-500 error-msg" id="error-country_id"></p>
        </div>

        <div class="mt-2">
            <input type="hidden" value="{{ @$studentDetails->state_id }}" id="hidden_state">

            <label for="state">State</label>
            <select id="state" name="state_id" class="border px-4 py-2" x-model="$store.stateStore.activeState">
                <option value="">Select</option>
                <template x-for="state in $store.stateStore.states" :key="state.id">
                    <option :value="state.id" x-text="state.name"></option>
                </template>
            </select>

            <p class="text-red-500 error-msg" id="error-state_id"></p>
        </div>
    </section>

    <section class="border-t mt-2">
        <template x-for="(qual, index) in $store.qualificationStore.qualification" :key="index">
            <div class="mt-2">
                <div>
                    <label for="qualification">Qualification</label>
                    <select
                        id="qualification"
                        name="qualification[]"
                        class="border px-4 py-2"
                        x-bind:value="qual.qualification_id">
                        <option value="">Select</option>
                        @foreach($basicData['qualifications'] as $qualification)
                        <option value="{{ $qualification->id }}"> {{ $qualification->label }} </option>
                        @endforeach
                    </select>
                    <p class="text-red-500 error-msg" :id="'error-qualification.' + index"></p>
                </div>

                <div>
                    <label for="year_of_passing">Month & year of passing</label>
                    <input
                        type="number"
                        id="year_of_passing"
                        name="year_of_passing[]"
                        x-bind:value="qual.year_of_passing"
                        class="h-8 border mt-1 rounded px-4 w-[200px] bg-gray-50" />
                    <p class="text-red-500 error-msg" :id="'error-year_of_passing.' + index"></p>
                </div>

                <div>
                    <label for="university">Name of the university</label>
                    <input
                        type="text"
                        id="university"
                        name="university[]"
                        x-bind:value="qual.university"
                        class="h-8 border mt-1 rounded px-4 w-[200px] bg-gray-50" />
                    <p class="text-red-500 error-msg" :id="'error-university.' + index"></p>
                </div>

                <div>
                    <template x-if="index == $store.qualificationStore.qualification.length - 1">
                        <button class="border border-gray-200 px-4 py-2" type="button" @click="$store.qualificationStore.add()">Add</button>
                    </template>
                    <template x-if="index > 0">
                        <button class="border border-gray-200 px-4 py-2" type="button" @click="$store.qualificationStore.remove(index)">Remove</button>
                    </template>
                </div>
            </div>
        </template>
    </section>

    <div class="mt-2">
        <button type="submit" class="border border-gray-500 px-4 py-2">Submit</button>

        <button type="button" class="border border-gray-500 px-4 py-2">
            <a href="{{ route('students.index') }}">Cancel</a>
        </button>
    </div>
</form>