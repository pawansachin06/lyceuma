<x-admin-layout>
    <div class="lg:container px-3 py-3">
        <div class="mb-2 flex flex-wrap justify-between items-center">
            <div class="">
                <h1 class="text-2xl font-sans font-semibold">Edit User</h1>
            </div>
            <div class="">
                <x-button href="{{ route('users.index') }}">Back</x-button>
            </div>
        </div>
        <form action="{{ route('users.update', $item) }}" method="post" data-js="app-form">
            @method('PUT')
            <div class="flex flex-wrap -mx-1">
                <div class="w-full sm:w-6/12 px-1 mb-2">
                    <div class="flex flex-col">
                        <span>Name</span>
                        <input type="text" name="name" value="{{ $item->name }}" required class="rounded focus:border-primary-500 focus:ring-primary-400" />
                    </div>
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-2">
                    <div class="flex flex-col">
                        <span>Surname</span>
                        <input type="text" name="lastname" value="{{ $item->lastname }}" class="rounded focus:border-primary-500 focus:ring-primary-400" />
                    </div>
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-2">
                    <div class="flex flex-col">
                        <span>Email</span>
                        <input type="email" name="email" value="{{ $item->email }}" required class="rounded focus:border-primary-500 focus:ring-primary-400" />
                    </div>
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-2">
                    <div class="flex flex-col">
                        <span>Phone</span>
                        <input type="number" name="phone" value="{{ $item->phone }}" required class="rounded focus:border-primary-500 focus:ring-primary-400" />
                    </div>
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-2">
                    <div class="flex flex-col">
                        <span>Username</span>
                        <input type="text" name="username" value="{{ $item->username }}" required class="rounded focus:border-primary-500 focus:ring-primary-400" />
                    </div>
                </div>
                @if( ($currentUser->isSuperAdmin() || $currentUser->isAdmin()) && !empty($user_roles) )
                    <div class="w-full sm:w-6/12 px-1 mb-2">
                        <div class="flex flex-col">
                            <span>Role</span>
                            <select name="role" class="rounded focus:border-primary-500 focus:ring-primary-400">
                                @foreach($user_roles as $user_role)
                                    <option value="{{ $user_role }}" <?php echo $user_role == $item->role->value ? 'selected' : ''; ?>>{{ $user_role }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif
                @if( $item->isTeacher() && !empty($classrooms) )
                <div class="w-full px-1 mb-3 select-none">
                    <div>Accessible Classrooms</div>
                    <div class="flex flex-wrap gap-x-5 gap-y-1">
                        @foreach($classrooms as $classroom)
                            <label class="inline-flex gap-2 items-center cursor-pointer">
                                <input type="checkbox" name="classroom_id[]" value="{{ $classroom->id }}" <?= in_array($classroom->id, $userClassrooms) ? 'checked' : '' ?> class="w-5 h-5 rounded my-1 border-gray-500 text-primary-500 shadow-sm focus:ring-primary-500 border-solid" />
                                <span>{{ $classroom->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                @endif
                @if( $item->isTeacher() && !empty($subjects) )
                <div class="w-full px-1 mb-3 select-none">
                    <div>Accessible Subjects</div>
                    <div class="flex flex-wrap gap-x-5 gap-y-1">
                        @foreach($subjects as $subject)
                            <label class="inline-flex gap-2 items-center cursor-pointer">
                                <input type="checkbox" name="subject_id[]" value="{{ $subject->id }}" <?= in_array($subject->id, $userSubjects) ? 'checked' : '' ?> class="w-5 h-5 rounded my-1 border-gray-500 text-primary-500 shadow-sm focus:ring-primary-500 border-solid" />
                                <span>{{ $subject->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                @endif
                <div class="w-full px-1">
                    <div data-js="app-form-status" class="hidden font-semibold hidden w-full mb-2"></div>
                    <x-button type="submit" data-js="app-form-btn">Update User</x-button>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>