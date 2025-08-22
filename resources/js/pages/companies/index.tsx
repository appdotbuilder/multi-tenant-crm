import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { AppShell } from '@/components/app-shell';

interface Company {
    id: number;
    name: string;
    email?: string;
    phone?: string;
    website?: string;
    industry?: string;
    employee_count?: number;
    status: string;
    contacts_count?: number;
    created_at: string;
}

interface PaginatedCompanies {
    data: Company[];
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
    links: Array<{
        url?: string;
        label: string;
        active: boolean;
    }>;
}

interface Props {
    companies: PaginatedCompanies;
    [key: string]: unknown;
}

export default function CompaniesIndex({ companies }: Props) {
    const getStatusColor = (status: string) => {
        switch (status) {
            case 'active': return 'text-green-600 bg-green-100';
            case 'prospect': return 'text-blue-600 bg-blue-100';
            default: return 'text-gray-600 bg-gray-100';
        }
    };

    const formatDate = (dateString: string) => {
        return new Date(dateString).toLocaleDateString();
    };

    return (
        <AppShell>
            <Head title="Companies" />
            
            <div className="space-y-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900">🏢 Companies</h1>
                        <p className="text-gray-600 mt-1">
                            Manage your company relationships and accounts
                        </p>
                    </div>
                    <Link
                        href="/companies/create"
                        className="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition-colors"
                    >
                        + Add Company
                    </Link>
                </div>

                {/* Stats */}
                <div className="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div className="bg-white p-4 rounded-lg shadow">
                        <div className="text-2xl font-bold text-gray-900">{companies.total}</div>
                        <div className="text-sm text-gray-600">Total Companies</div>
                    </div>
                    <div className="bg-white p-4 rounded-lg shadow">
                        <div className="text-2xl font-bold text-green-600">
                            {companies.data.filter(c => c.status === 'active').length}
                        </div>
                        <div className="text-sm text-gray-600">Active</div>
                    </div>
                    <div className="bg-white p-4 rounded-lg shadow">
                        <div className="text-2xl font-bold text-blue-600">
                            {companies.data.filter(c => c.status === 'prospect').length}
                        </div>
                        <div className="text-sm text-gray-600">Prospects</div>
                    </div>
                    <div className="bg-white p-4 rounded-lg shadow">
                        <div className="text-2xl font-bold text-gray-600">
                            {companies.data.filter(c => c.status === 'inactive').length}
                        </div>
                        <div className="text-sm text-gray-600">Inactive</div>
                    </div>
                </div>

                {/* Companies Table */}
                <div className="bg-white rounded-lg shadow">
                    <div className="overflow-x-auto">
                        <table className="min-w-full divide-y divide-gray-200">
                            <thead className="bg-gray-50">
                                <tr>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Company
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Industry
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Size
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Contacts
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Created
                                    </th>
                                    <th className="relative px-6 py-3">
                                        <span className="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody className="bg-white divide-y divide-gray-200">
                                {companies.data.map((company) => (
                                    <tr key={company.id} className="hover:bg-gray-50">
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <div>
                                                <Link
                                                    href={`/companies/${company.id}`}
                                                    className="text-lg font-semibold text-gray-900 hover:text-blue-600"
                                                >
                                                    {company.name}
                                                </Link>
                                                {company.email && (
                                                    <div className="text-sm text-gray-600">{company.email}</div>
                                                )}
                                                {company.phone && (
                                                    <div className="text-sm text-gray-600">{company.phone}</div>
                                                )}
                                            </div>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {company.industry || '-'}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {company.employee_count ? `${company.employee_count.toLocaleString()} employees` : '-'}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <span className={`inline-block px-2 py-1 text-xs font-medium rounded-full ${getStatusColor(company.status)}`}>
                                                {company.status}
                                            </span>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {company.contacts_count || 0}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {formatDate(company.created_at)}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div className="flex items-center space-x-2">
                                                <Link
                                                    href={`/companies/${company.id}`}
                                                    className="text-blue-600 hover:text-blue-900"
                                                >
                                                    View
                                                </Link>
                                                <Link
                                                    href={`/companies/${company.id}/edit`}
                                                    className="text-indigo-600 hover:text-indigo-900"
                                                >
                                                    Edit
                                                </Link>
                                            </div>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>

                    {/* Pagination */}
                    {companies.last_page > 1 && (
                        <div className="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                            <div className="flex items-center justify-between">
                                <div className="flex-1 flex justify-between sm:hidden">
                                    {companies.links[0]?.url && (
                                        <Link
                                            href={companies.links[0].url!}
                                            className="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                                        >
                                            Previous
                                        </Link>
                                    )}
                                    {companies.links[companies.links.length - 1]?.url && (
                                        <Link
                                            href={companies.links[companies.links.length - 1].url!}
                                            className="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                                        >
                                            Next
                                        </Link>
                                    )}
                                </div>
                                <div className="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                    <div>
                                        <p className="text-sm text-gray-700">
                                            Showing{' '}
                                            <span className="font-medium">
                                                {(companies.current_page - 1) * companies.per_page + 1}
                                            </span>{' '}
                                            to{' '}
                                            <span className="font-medium">
                                                {Math.min(companies.current_page * companies.per_page, companies.total)}
                                            </span>{' '}
                                            of{' '}
                                            <span className="font-medium">{companies.total}</span> results
                                        </p>
                                    </div>
                                    <div>
                                        <nav className="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                            {companies.links.map((link, index) => {
                                                if (link.url) {
                                                    return (
                                                        <Link
                                                            key={index}
                                                            href={link.url!}
                                                            className={`relative inline-flex items-center px-4 py-2 border text-sm font-medium ${
                                                                link.active
                                                                    ? 'z-10 bg-blue-50 border-blue-500 text-blue-600'
                                                                    : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50'
                                                            }`}
                                                        >
                                                            <span dangerouslySetInnerHTML={{ __html: link.label }} />
                                                        </Link>
                                                    );
                                                } else {
                                                    return (
                                                        <span
                                                            key={index}
                                                            className="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-300"
                                                            dangerouslySetInnerHTML={{ __html: link.label }}
                                                        />
                                                    );
                                                }
                                            })}
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    )}
                </div>
            </div>
        </AppShell>
    );
}