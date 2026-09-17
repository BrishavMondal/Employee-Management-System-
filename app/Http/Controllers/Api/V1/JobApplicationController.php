

Use:

```php
<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreJobApplicationRequest;
use App\Http\Requests\Api\UpdateJobApplicationRequest;
use App\Http\Resources\JobApplicationResource;
use App\Models\JobApplication;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class JobApplicationController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = JobApplication::with('employee');

        if ($request->filled('search')) {
            $search = $request->string('search');

            $query->where(function ($q) use ($search) {
                $q->where(
                    'position',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'status',
                    'like',
                    "%{$search}%"
                )
                ->orWhereHas(
                    'employee',
                    function ($employeeQuery) use ($search) {
                        $employeeQuery
                            ->where(
                                'employee_id',
                                'like',
                                "%{$search}%"
                            )
                            ->orWhere(
                                'first_name',
                                'like',
                                "%{$search}%"
                            )
                            ->orWhere(
                                'last_name',
                                'like',
                                "%{$search}%"
                            )
                            ->orWhere(
                                'email',
                                'like',
                                "%{$search}%"
                            );
                    }
                );
            });
        }

        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->status
            );
        }

        $applications = $query
            ->latest('application_date')
            ->paginate(10)
            ->withQueryString();

        return JobApplicationResource::collection(
            $applications
        );
    }

    public function store(
        StoreJobApplicationRequest $request
    ): JobApplicationResource {
        $application = JobApplication::create(
            $request->validated()
        );

        $application->load('employee');

        return new JobApplicationResource(
            $application
        );
    }

    public function show(
        JobApplication $jobApplication
    ): JobApplicationResource {
        $jobApplication->load('employee.department');

        return new JobApplicationResource(
            $jobApplication
        );
    }

    public function update(
        UpdateJobApplicationRequest $request,
        JobApplication $jobApplication
    ): JobApplicationResource {
        $jobApplication->update(
            $request->validated()
        );

        $jobApplication->load('employee');

        return new JobApplicationResource(
            $jobApplication
        );
    }

    public function destroy(
        JobApplication $jobApplication
    ): JsonResponse {
        $jobApplication->delete();

        return response()->json([
            'message' => 'Job application deleted successfully.',
        ], 200);
    }
}