import AppLayout from '@/layouts/app-layout';
// import { dashboard} from '@/routes';
import { useState } from 'react';

import { toast } from "sonner";
import { type BreadcrumbItem } from '@/types';
import { Button } from '@/components/ui/button';
import { Head, Link } from '@inertiajs/react';
// import Modal from '@/components/ui/modal';
import CreateJobForm from './Create';
import { Dialog, DialogFooter, DialogHeader, DialogContent, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { Card, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
// import { DialogContent, DialogTitle, DialogTrigger } from '@radix-ui/react-dialog';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Jobs',
        href: '/jobs',
    },
];

interface Job {
    id: number;
    title: string;
    salary: number;
}

interface IndexProps {
    jobs: {
        data: Job[];
        links: { url: string | null; label: string; active: boolean }[];
    };
}

export default function Index({ jobs }: IndexProps) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Jobs" />

            {/* ✅ Job Cards Section */}
            <div className="p-3 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                {jobs.data.length === 0 ? (
                    <p className="text-gray-500">No jobs found.</p>
                ) : (
                    jobs.data.map((job) => (
                        <Link
                            key={job.id}
                            href={`/jobs/${job.id}`}
                            className="block transition-transform hover:scale-[1.01]"
                        >
                            <Card className="hover:shadow-md transition">
                                <CardHeader>
                                    <CardTitle className="text-blue-600">{job.title}</CardTitle>
                                    <CardDescription>Salary: {job.salary}</CardDescription>
                                </CardHeader>
                            </Card>
                        </Link>
                    ))
                )}
            </div>



        </AppLayout >
    );
}
