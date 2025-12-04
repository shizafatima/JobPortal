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
import { Inertia } from '@inertiajs/inertia';
import { Pagination, PaginationContent, PaginationEllipsis, PaginationItem, PaginationLink, PaginationNext, PaginationPrevious } from '@/components/ui/pagination';
// import { DialogContent, DialogTitle, DialogTrigger } from '@radix-ui/react-dialog';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Jobs',
        href: '/jobs',
    },
];

interface Job {
    id: number;
    company: Company;
    title: string;
    salary: number;
}

interface Company {
    id: number;
    name: string;
}

interface IndexProps {
    jobs: {
        data: Job[];
        links: { url: string | null; label: string; active: boolean }[];
    };
}

export default function Index({ jobs }: IndexProps) {
    const handlePagination = (url?: string | null) => {
        if (!url) return
        Inertia.get(url, {}, { preserveState: true })
    }

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

                            href={`/jobs/myJobs`}
                            className="block transition-transform hover:scale-[1.01]"
                        >
                            <Card className="block transition-transform hover:scale-[1.01]">
                                <CardHeader>
                                    <CardTitle>{job.company?.name ?? "No Company"}</CardTitle>
                                    <CardTitle className="text-blue-600">{job.title}</CardTitle>
                                    <CardDescription>Salary: {job.salary}</CardDescription>
                                </CardHeader>
                            </Card>
                        </Link>
                    ))
                )}
            </div>

            {/* PAGINATION */}
            <Pagination>
                <PaginationContent>
                    {/* previous */}
                    <PaginationPrevious
                        onClick={() => handlePagination(jobs.links[0].url)}
                        className={!jobs.links[0].url ? "opacity-50 pointer-events-none" : ""}
                    />

                    {/* page numbers */}
                    {jobs.links.slice(1, -1).map((link, index) => {
                        if (link.label === '…') {
                            return (
                                <PaginationEllipsis key={index} />
                            )
                        }

                        return (
                            <PaginationItem key={index}>
                                <PaginationLink 
                                isActive={link.active}
                                onClick={() => handlePagination(link.url)}
                                >
                                    {link.label.replace(/&laquo;|&raquo;/g, '')}
                                </PaginationLink>
                            </PaginationItem>
                        )
                    }

                    )}

                    {/* next */}
                    <PaginationNext
                    onClick={() => handlePagination(jobs.links[jobs.links.length - 1].url)}
                    className={!jobs.links[jobs.links.length - 1].url ? "opacity-50 pointer-events-none" : ""}/>
                </PaginationContent>
            </Pagination>



        </AppLayout >
    );
}
